<?php

namespace App\Services;

use App\Models\AccountingConsultation;

class AccountingConsultationsService
{
    public function getFirst(string $locale = 'ru'): object
    {
        $consultation = AccountingConsultation::first();

        if (! $consultation) {
            $consultation = $this->createDefault();
        }

        return $this->format($consultation, $locale);
    }

    protected function createDefault(): AccountingConsultation
    {
        return AccountingConsultation::create([
            'title' => 'Получите помощь бухгалтера не выходя из дома',
            'title_kk' => 'Бухгалтердің көмегін үйден шықпай алыңыз',
            'title_en' => 'Get accounting help without leaving home',

            'description' => 'Профессиональная консультация бухгалтера онлайн',
            'description_kk' => 'Бухгалтердің онлайн кеңесі',
            'description_en' => 'Professional online accounting consultation',

            'button_text' => 'Получить консультацию',
            'button_text_kk' => 'Кеңес алу',
            'button_text_en' => 'Get consultation',
        ]);
    }

    protected function format(AccountingConsultation $c, string $locale): object
    {
        return (object) [
            'title' => $c->{'title_'.$locale} ?? $c->title,
            'description' => $c->{'description_'.$locale} ?? $c->description,
            'button_text' => $c->{'button_text_'.$locale} ?? $c->button_text,
        ];
    }
}
