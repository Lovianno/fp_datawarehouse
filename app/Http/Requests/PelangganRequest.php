<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelangganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('pelanggan')?->id_pelanggan;
        return [
            'kode_pelanggan' => ['required', 'string', 'max:50', 'unique:pelanggan,kode_pelanggan,' . $id . ',id_pelanggan'],
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'jenis_kelamin'  => ['required', 'in:L,P'],
            'kota'           => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_pelanggan.required' => 'Kode pelanggan wajib diisi.',
            'kode_pelanggan.unique'   => 'Kode pelanggan sudah digunakan.',
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'        => 'Jenis kelamin tidak valid.',
            'kota.required'           => 'Kota wajib diisi.',
        ];
    }
}
