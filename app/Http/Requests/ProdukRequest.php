<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return match ($this->method()) {
            'POST'         => $this->createRules(),
            'PUT', 'PATCH' => $this->updateRules(),
            default        => [],
        };
    }

    protected function createRules(): array
    {
        return [
            'kode_produk' => ['required', 'string', 'max:20', 'unique:produk,kode_produk'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori'    => ['required', 'string', 'max:100'],
            'harga'       => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function updateRules(): array
    {
        return [
            'kode_produk' => [
                'required', 'string', 'max:20',
                Rule::unique('produk', 'kode_produk')->ignore($this->route('produk'), 'id_produk'),
            ],
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori'    => ['required', 'string', 'max:100'],
            'harga'       => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_produk.required' => 'Kode produk wajib diisi.',
            'kode_produk.unique'   => 'Kode produk sudah terdaftar.',
            'kode_produk.max'      => 'Kode produk maksimal 20 karakter.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'nama_produk.max'      => 'Nama produk maksimal 255 karakter.',
            'kategori.required'    => 'Kategori wajib diisi.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
            'harga.min'            => 'Harga tidak boleh negatif.',
        ];
    }
}
