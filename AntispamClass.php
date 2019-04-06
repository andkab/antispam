<?php

# Антиспам
class AntiSpam
{

    public static function SpamProtect($stockText)
    {    
	
        # Установка текста в нижний регистр
        $registrText = mb_strtolower($stockText);

        # Замена кирилицы на латиницу
        $stringRus = ['у', 'к', 'е', 'а', 'г', 'о', 'с', 'и', 'м', '0', 'х'];
        $stringLat = ['y', 'k', 'e', 'a', 'r', 'o', 'c', 'u', 'm', 'о', 'x'];
        $textLat = str_replace($stringRus, $stringLat, $registrText);
        $clearLat = preg_replace("/[^,\p{Latin}]/ui", null, $textLat);

        # Замена латиницы на кирилицу
        $stringsLat = ['y', 'k', 'e', 'a', 'r', 'o', 'c', 'u', 'm', 'x'];
        $stringsRus = ['у', 'к', 'е', 'а', 'г', 'о', 'с', 'и', 'м', 'х'];
        $textRus = str_replace($stringsLat, $stringsRus, $registrText);
        $clearRus = preg_replace("/[^,\p{Cyrillic}]/ui", null, $textRus);

        # Массив спам-слов
        $arraySpam = [
            'github',
            'microsoft'
        ];		
		
		# Поиск спам-слов
		foreach ($arraySpam as $fragment) {
			if (mb_strpos($clearLat, $fragment) !== false) {
				return 'Всем хорошего дня :)';
			} elseif (mb_strpos($clearRus, $fragment) !== false) {
				return 'Всем хорошего дня :)';
			}
		} 

		# Возврат оригинального текста
		return $stockText;		

	}
}
