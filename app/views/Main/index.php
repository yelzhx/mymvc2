<h2>Лицевой счет</h2>

<form method="POST" action="/main/logout">
    <table>
        <tr>
            <td>
                <button type="submit">Выйти</button>
            </td>
        </tr>
    </table>
</form>

<form method="POST" action="" onsubmit="return confirm('Вы уверены что хотите снять деньги?')">
    <table>
        <tr>
            <td>
                <label for="username">Пользователь</label>
            </td>
            <td>
                <label for="username"><?=$username?></label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="amount">Баланс</label>
            </td>
            <td>
                <label for="username"><?=$amount?>.00</label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="get_money">Вывести</label>
            </td>
            <td>
                <input type="text" name="get_money" value="0" style="text-align: right; "> .00 тенге
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit">Снять</button>
            </td>
        </tr>
    </table>
</form>