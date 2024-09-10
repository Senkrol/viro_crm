<x-mail::message>
# Здравствуйте, {{ $respectfulЕreatment }}!

Вам предоставлен доступ к разделу XXX в единой информационной системе АОУ ВО ДПО «ВИРО»


<x-mail::panel>
Пароль: {{ $password }}<br>
Логин: {{ $login }}
</x-mail::panel>



<x-mail::button :url="'https://crm.viro.edu.ru/'">
Перейти в систему
</x-mail::button>

</x-mail::message>
