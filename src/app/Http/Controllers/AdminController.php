<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->getSearchQuery($request);

        $contacts = $query
            ->orderBy('created_at', 'desc')
            ->paginate(7)
            ->appends($request->query());

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function export(Request $request): StreamedResponse
    {
        $query = $this->getSearchQuery($request);

        $contacts = $query
            ->orderBy('created_at', 'desc')
            ->get();

        $csvHeader = [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
            '作成日時',
        ];

        $fileName = 'contacts_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($contacts, $csvHeader) {
            $stream = fopen('php://output', 'w');

            // Excelで文字化けしにくくするためBOMを付与
            fwrite($stream, "\xEF\xBB\xBF");

            fputcsv($stream, $csvHeader);

            foreach ($contacts as $contact) {
                fputcsv($stream, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $this->genderText($contact->gender),
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content,
                    $contact->detail,
                    $contact->created_at,
                ]);
            }

            fclose($stream);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect('/admin');
    }

    private function getSearchQuery(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $keywordWithoutSpace = str_replace([' ', '　'], '', $keyword);

            $query->where(function ($query) use ($keyword, $keywordWithoutSpace) {
                $query->where('last_name', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keywordWithoutSpace}%"])
                    ->orWhereRaw("CONCAT(first_name, last_name) LIKE ?", ["%{$keywordWithoutSpace}%"])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$keyword}%"])
                    ->orWhereRaw("CONCAT(last_name, '　', first_name) LIKE ?", ["%{$keyword}%"])
                    ->orWhereRaw("CONCAT(first_name, '　', last_name) LIKE ?", ["%{$keyword}%"]);
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }

    private function genderText($gender): string
    {
        if ($gender == 1) {
            return '男性';
        }

        if ($gender == 2) {
            return '女性';
        }

        return 'その他';
    }
}
