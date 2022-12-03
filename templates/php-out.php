<h1>Проверка PHP</h1>

<h2>Версия интерпретатора</h2>
<table>
<tr class="h"><th>Требуется версия или выше</th><th>Установлена версия</th></tr>
<tr>
    <td class="v"><?php  echo $php->minreq;?></td>
    <td class="v"><?php  H::validOrNot($php->valid, $php->version);?></td>
</tr>
</table>

<h2>Требуемые функции</h2>
<table>
<tr class="h"><th>Требуемая функция</th><th>Определена</th></tr>
<?php foreach ($funcs as $func): ?>
    <tr>
        <td class="e"><?php echo $func->name;?></td>
        <td class="v"><?php  H::boolToString($func->able);?></td>
    </tr>
<?php endforeach; ?>
</table>

<h2>Требуемые расширения</h2>
<p>Данные расширения необходимы для работы приложения<p>
<table>
<tr class="h"><th>Расширение</th><th>Версия</th><th>Наличие</th></tr>
<?php foreach ($needs as $ext): ?>
    <tr>
        <td class="e"><?php echo $ext->name;?></td>
        <td class="v"><?php  echo $ext->version;?></td>
        <td class="v">  <?php  H::existOrNot($ext->exist); ?>  </td>
    </tr>
<?php endforeach; ?>
</table>

<h2>Рекомендуемые расширения</h2>
<p>Данные расширения не являются необходимыми, но без них может быть недоступна часть функционала 
(обновление, кеширование, отдельные компоненты). <p>
<table>
<tr class="h"><th>Расширение</th><th>Версия</th><th>Наличие</th></tr>
<?php foreach ($recomm as $ext): ?>
    <tr>
        <td class="e"><?php echo $ext->name;?></td>
        <td class="v"><?php  echo $ext->version;?></td>
        <td class="v">  <?php  H::existOrNeutral($ext->exist); ?>  </td>
    </tr>
<?php endforeach; ?>
</table>
<?php if ($errors != 0): ?>
    <p class="bad">Критических ошибок: <?php echo $errors; ?>, приложение не сможет функционировать.</p>
<?php else: ?>
    <p class="good">Критических ошибок настройки PHP нет, приложение сможет функционировать.</p>
<?php endif; ?>    