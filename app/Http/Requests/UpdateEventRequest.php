<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
        return [
            'event_title' => ['required', 'string', 'max:50'],
            'event_subtitle' => ['nullable', 'string', 'max:100'],
            'location_id' => ['nullable', 'exists:event_locations,id'],
            'dress_code_id' => ['nullable', 'exists:event_dress_codes,id'],
            'event_price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'event_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'galleries' => ['nullable', 'array', 'max:15'],
            'galleries.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'event_description' => ['nullable', 'string'],
            'event_region' => ['required', 'string', 'in:Abruzzo,Basilicata,Calabria,Campania,Emilia-Romagna,Friuli-Venezia Giulia,Lazio,Liguria,Lombardia,Marche,Molise,Piemonte,Puglia,Sardegna,Sicilia,Toscana,Trentino-Alto Adige,Umbria,Valle d\'Aosta,Veneto'],
            'event_city' => ['required', 'string', 'max:50'],
            'event_address' => ['required', 'string', 'max:100'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'event_start' => ['required', 'date_format:H:i'],
            'event_end' => ['required', 'date_format:H:i'],
        ];
    }

    
    public function messages(){

        return [
            'event_title.required' => 'Il titolo è obbligatorio.',
            'event_title.string' => 'Il titolo deve essere un testo valido.',
            'event_title.max' => 'Il titolo non deve superare i 50 caratteri.',

            'event_subtitle.nullable' => 'Il sottotitolo è facoltativo.',
            'event_subtitle.string' => 'Il sottotitolo deve essere un testo valido.',
            'event_subtitle.max' => 'Il sottotitolo non deve superare i 100 caratteri.',

            'location_id.nullable' => 'La location è facoltativa.',
            'location_id.exists' => 'La location selezionata non è valida.',

            'dress_code_id.nullable' => 'Il dress code è facoltativo.',
            'dress_code_id.exists' => 'Il dress code selezionato non è valido.',

            'event_price.required' => 'Il prezzo è obbligatorio.',
            'event_price.numeric' => 'Il prezzo deve essere un numero valido.',
            'event_price.min' => 'Il prezzo non deve essere inferiore a 0.',
            'event_price.max' => 'Il prezzo non deve superare 99999999.99.',

            'event_img.nullable' => 'L\'immagine in primo piano è facoltativa.',
            'event_img.image' => 'L\'immagine in primo piano deve essere in file immagine valido.',
            'event_img.mimes' => 'L\'immagine in primo piano deve essere un\'immagine di tipo: jpeg, png, jpg.',
            'event_img.max' => 'L\'immagine in primo piano non deve superare i 2048 kilobyte.',

            'galleries.nullable' => 'Le immagini secondarie sono facoltative.',
            'galleries.array' => 'Le immagini secondarie devono essere un array di immagini.',
            'galleries.max' => 'Le immagini secondarie devono essere massimo 15.',

            'galleries.*.image' => 'Ciascuna immagine secondaria deve essere un file immagine valido.',
            'galleries.*.mimes' => 'Ciascuna immagine secondaria deve essere un\'immagine di tipo: jpeg, png, jpg.',
            'galleries.*.max' => 'Ciascuna immagine secondaria non deve superare i 2048 kilobyte.',

            'event_description.nullable' => 'La descrizione è facoltativa.',
            'event_description.string' => 'La descrizione deve essere un testo valido.',

            'event_region.required' => 'La Regione è obbligatoria.',
            'event_region.string' => 'La Regione deve essere un testo valido.',
            'event_region.in' => 'La Regione selezionata non è valida.',

            'event_city.required' => 'Il Comune è obbligatorio.',
            'event_city.string' => 'Il Comune deve essere un testo valido.',
            'event_city.max' => 'Il Comune non deve superare i 50 caratteri.',

            'event_address.required' => 'L\'indirizzo è obbligatorio.',
            'event_address.string' => 'L\'indirizzo deve essere un testo valido.',
            'event_address.max' => 'L\'indirizzo non deve superare i 100 caratteri.',

            'event_date.required' => 'La data è obbligatoria.',
            'event_date.date' => 'La data deve essere una data valida.',
            'event_date.after_or_equal' => 'La data deve essere oggi o successiva.',

            'event_start.required' => 'L\'orario di inizio deve essere obbligatorio.',
            'event_start.date_format' => 'L\'orario di inizio deve essere nel formato HH:MM.',

            'event_end.required' => 'L\'orario di fine deve essere obbligatorio.',
            'event_end.date_format' => 'L\'orario di fine deve essere nel formato HH:MM.',

        ];
    }
}