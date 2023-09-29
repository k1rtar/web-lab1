<table class="results-table">
                        <tr>
                            <td>X</td>
                            <td>Y</td>
                            <td>R</td>
                            <td>Результат</td>
                            <td>Текущее время</td>
                            <td>Время выполнения</td>
                        </tr>

                    </table>

                    <?php foreach ($_SESSION["dataHistory"] as $value){ ?>
    <tr class="results-table">
        <td><?php echo $value[0] ?></td>
        <td><?php echo $value[1] ?></td>
        <td><?php echo $value[2] ?></td>
        <?php echo $value[3] ? "<td style='color: green'>Попадание</td>" : "<td style='color: red'>Промах</td>"; ?>
        <td><?php echo $value[4] ?></td>
        <td><?php echo $value[5] ?> с</td>
    </tr>
<?php } ?>    