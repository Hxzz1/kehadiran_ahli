<!-- ubah saiz tulisan -->
<script>

funtion changesize(multiple) {
        //get the current size when type in table
        var size = document.getElementById("size");
        var current_size = size.style.fontSize || 1;

        /* checking if user push any button
            reset button - value 2 sent     - back to original size
             + button - value 1 sent        - bigger size
             - button - value -1 sent       -smaller size
        */

        if (multiple == 2) {
            size.style.fontSize = "1em";
        }
        else {
            size.style.fontSize = (parseFloat(current_size) + (multiple * 0.2)) + "em";
        }
    }
</script>

<!-- button code for change the writing size -->
| tukar saiz tulisan |
<input name='reSize1' type='button' value='reset' onclick="changesize(2)" />
<input name='reSize' type='button' value='&nbsp;+&nbsp;' onclick="changesize(1)" />
<input name='reSize2' type='button' value='&nbsp;+&nbsp;' onclick="changesize(-1)" />
|
<button onclick="window.print()">Cetak</button>