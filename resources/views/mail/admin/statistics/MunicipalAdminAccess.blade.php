<x-mail::message>
# Здравствуйте, {{ $respectfulЕreatment }}!

Вам предоставлен доступ к разделу «Статистика» в единой информационной системе АОУ ВО ДПО «ВИРО»


<x-mail::panel>
Логин: {{ $login }}<br>
Пароль: {{ $password }}
</x-mail::panel>

<x-mail::button :url="'https://crm.viro.edu.ru/'">
Перейти в систему
</x-mail::button>

</x-mail::message>
