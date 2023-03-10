<?php
// Copy Paste ke template editor [Settings -> Template Editor].

if (substr($validity, -1) == "d") {
    $validity = "Aktif:" . substr($validity, 0, -1) . "Hari";
} else if (substr($validity, -1) == "h") {
    $validity = "Aktif:" . substr($validity, 0, -1) . "Jam";
}
if (substr($timelimit, -1) == "d" & strlen($timelimit) > 3) {
    $timelimit = "Durasi:" . ((substr($timelimit, 0, -1) * 7) +  substr($timelimit, 2, 1)) . "Hari";
} else if (substr($timelimit, -1) == "d") {
    $timelimit = "Durasi:" . substr($timelimit, 0, -1) . "Hari";
} else if (substr($timelimit, -1) == "h") {
    $timelimit = "Durasi:" . substr($timelimit, 0, -1) . "Jam";
} else if (substr($timelimit, -1) == "w") {
    $timelimit = "Durasi:" . (substr($timelimit, 0, -1) * 7) . "Hari";
}

/* 
Sesuikan harga dan warna masing-masing.
warna bisa dilihat di https://material.io/guidelines/style/color.html#color-color-palette
variable $color
background-color:<?php echo $color;?>; -webkit-print-color-adjust: exact;
ditambahkan ke style di tag html yang ingin dikasi warna.
*/

if ($getsprice == "1000") {
    $color = "#2196F3";
} // jika harga == "1000" maka warna = "#2196F3"
elseif ($getsprice == "3000") {
    $color = "#009688";
} elseif ($getsprice == "5000") {
    $color = "#FF9800";
} // ini yang dicopy untuk menambah warna berdarsarkan harga, kemudian paste di atas baris // else color

// else color
else {
    $color = "#FFFFFF";
}
?>

<style type="text/css">
    .rotate {
        vertical-align: center;
        text-align: center;
    }

    .rotate span {
        -ms-writing-mode: tb-rl;
        -webkit-writing-mode: vertical-rl;
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        white-space: nowrap;
    }

    .qrcode {
        height: 60px;
        width: 60px;
    }
</style>

<table class="voucher" style="width: 230px;">
    <tbody>
        <tr>
            <td class="rotate" style="font-weight: bold; border-right: 1px solid black; background-color:<?php echo $color; ?>; -webkit-print-color-adjust: exact;" rowspan="4"><span><?= $price; ?></span></td>
            <td style="font-weight: bold" colspan="2"><?= $hotspotname; ?> </td>
            <?php if ($qr == "yes") { ?>
                <td style="" rowspan="3"><?= $qrcode ?></td>
            <?php
            } else { ?>
                <td style="" rowspan="3"><img style="width: 60px; height: 60px;" src="<?= $logo ?>" alt="logo"></td>
            <?php
            } ?>
        </tr>
        <tr>
            <?php if ($usermode == "vc") { ?>
                <td style="width: 100%; font-weight: bold; font-size: 20px; text-align: center;"><?= $username; ?></td>
            <?php
            } elseif ($usermode == "up") { ?>
                <td style="width: 100%; font-weight: bold; font-size: 15px; text-align: center;"><?= "User: " . $username . "<br>Pass: " . $password; ?></td>
            <?php
            } ?>
        </tr>
        <tr>
            <td style="font-size: 10px;"><?= $validity; ?> <?= $timelimit; ?> <?= $datalimit; ?></td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 10px;">Login: http://<?= $dnsname; ?> <span id="num"> <?= " [$num]"; ?></span></td>
        </tr>
    </tbody>
</table>