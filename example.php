<?php
require 'vendor/autoload.php';

$contents = <<<PLIST
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple Computer//DTD PLIST 1.0//EN"
    "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
  <dict>
  <key>Year Of Birth</key>
  <integer>1965</integer>
  <key>Photo</key>
  <data>
    PEKBpYGlmYFCPAfekjf39495265Afgfg0052fj81DG==
  </data>
  <key>Hobby</key>
  <string>Swimming</string>
  <key>Jobs</key>
  <array>
    <string>Software engineer</string>
    <string>Salesperson</string>
  </array>
  </dict>
</plist>
PLIST;

dump(MindOfMicah\Plist\Parser::parseXML($contents, 'dict'));
