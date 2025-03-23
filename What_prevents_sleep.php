##### I tweaked the original script so you can run it directly without summoning it from the terminal and it displays results as a Zenity Popup
##### Place the icon png into /usr/share/icons/gnome/48x48/status



#!/usr/bin/php
<?php

$list = `dbus-send --print-reply --dest=org.gnome.SessionManager /org/gnome/SessionManager org.gnome.SessionManager.GetInhibitors`;
$l = explode("\n", $list);

$found = false;
$output = '';

foreach ($l as $a) {
    $a = trim($a);
    if ($found) {
        if ($a == "]") {
            break;
        }
        if (substr($a, 0, 13) == 'object path "'){
            $inhibitor = substr($a, 13, strlen($a) - 14);

            $info = `dbus-send --print-reply --dest=org.gnome.SessionManager $inhibitor org.gnome.SessionManager.Inhibitor.GetAppId`;
            $names = explode("\n", $info);
            $n = trim($names[1]);

            if (substr($n, 0, 8) == 'string "'){
                $name = substr($n, 8, strlen($n) - 9);
                $pid = trim(`pgrep -f "$name"`);
                $output .= "Inhibitor: $inhibitor\nApp: $name\nPID: $pid\n\n";
            }
        }
    } elseif ($a == "array [") {
        $found = true;
    }
}

file_put_contents('/tmp/zenity_output.log', $output);

if (!empty($output)) {
    $output = addslashes(trim($output));
    
    exec("zenity --warning --title='Process Preventing Sleep' --text=\"$output\"");
} else {
    exec("zenity --info --title='Process Preventing Sleep' --icon-name=green-checkmark --text='No inhibitors found.'");
}
