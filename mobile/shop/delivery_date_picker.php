<?php
include_once('./_common.php');

$g5['title'] = 'Delivery date picker';
include_once(G5_PATH.'/head.sub.php');

$booking_period = $default['de_avail_booking_period'];

?>

<div class="delivery_date_picker">

    <h1>When would you like your shopping delivered?</h1>

    <div class="tbl_wrap">
        <table>
            <thead>
            <tr>
                <td></td>

                <?php
                for($i=1; $i <= $booking_period; $i++ ) {
                    $tmp_date = date('Y M d D', strtotime(date('Y-m-d') .' +'.$i.' day'));
                    $date = explode(' ', $tmp_date);
                    ?>
                    <td class="col_header"><?php echo $date[2].' '.$date[1]; ?><br>(<?php echo $date[3]; ?>)</td>

                <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="row_header">10:00 AM<br>~<br>12:00 PM</td>
                <?php
                for($i=1; $i <= $booking_period; $i++ ) {
                    $tmp_date = date('Y M d D', strtotime(date('Y-m-d') .' +'.$i.' day'));
                    $date = explode(' ', $tmp_date);

                    $key = 'sb_'.strtolower($date[3]);
                    if ( $delivery_avail[$key] == '1') {
                        ?>
                        <td class="row_cell delivery_pick">Click
                            <?php
                            $del_date = date('Y-m-d', strtotime(date('Y-m-d') .' +'.$i.' day'));
                            ?>
                            <input type="hidden" name="delivery_date" value="<?php echo $del_date; ?>">
                            <input type="hidden" name="delivery_time" value="10:00~12:00">
                        </td>
                    <?php
                    } else {
                        ?>
                        <td class="row_cell_na">N/A</td>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </tr>
            <tr>
                <td class="row_header">01:00 PM<br>~<br>03:00 PM</td>
                <?php
                for($i=1; $i <= $booking_period; $i++ ) {
                    $tmp_date = date('Y M d D', strtotime(date('Y-m-d') .' +'.$i.' day'));
                    $date = explode(' ', $tmp_date);

                    $key = 'sb_'.strtolower($date[3]);
                    if ( $delivery_avail[$key] == '1') {
                        ?>
                        <td class="row_cell delivery_pick">Click
                            <?php
                            $del_date = date('Y-m-d', strtotime(date('Y-m-d') .' +'.$i.' day'));
                            ?>
                            <input type="hidden" name="delivery_date" value="<?php echo $del_date; ?>">
                            <input type="hidden" name="delivery_time" value="13:00~15:00">
                        </td>
                    <?php
                    } else {
                        ?>
                        <td class="row_cell_na">N/A</td>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="win_btn">
        <button type="button" onclick="self.close();">Close</button>
    </div>
</div>
<script>
    $(function(){
        $(".delivery_pick").click(function () {

            var delivery_date = $(this).children("input[name='delivery_date']").val();
            var delivery_time = $(this).children("input[name='delivery_time']").val();

            console.log(delivery_date);
            console.log(delivery_time);

            var f = window.opener.forderform;
            f.od_hope_date.value = delivery_date;
            f.od_hope_time.value = delivery_time;

            window.close();
        });
    });

</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>