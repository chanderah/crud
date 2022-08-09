<?php


if ($d->conveyance == 'Darat') {
    $darat = 
    'By ' . $d->conveyance_by . '
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">Type : ' . $d->conveyance_type . '</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">Police No. : ' . $d->conveyance_policeno . '</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">Driver : '  . $d->conveyance_driver . '</td>
    </tr>
    ';

    $html = str_replace('{conveyance}', $darat, $html);

} elseif ($d->conveyance == 'Laut') {

    $laut = 
    'By Vessel - ' . $d->conveyance_ship_name .'
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">Type : ' . $d->conveyance_ship_type . '</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">GRT : ' . $d->conveyance_ship_GRT . '</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">Year of Build : '  . $d->conveyance_ship_birth . '</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">Container No. : '  . $d->conveyance_ship_containerno . '</td>
    </tr>
    ';

    $html = str_replace('{conveyance}', $laut, $html);

} elseif ($d->conveyance == 'Udara') {
    $udara =
    'By Plane    
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">Type : ' . $d->conveyance_plane_type . '</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td colspan="1" align="right"></td>
        <td colspan="8"align="justify">AWB No. : ' . $d->conveyance_plane_AWB . '</td>
    </tr>
    '; 

    $html = str_replace('{conveyance}', $udara, $html);
}
