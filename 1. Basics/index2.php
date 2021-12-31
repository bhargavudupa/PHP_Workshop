<?php
$var1 = 25;
$var2 = 30;
$var3 = $var1 + $var2;

// The <pre> tag defines preformatted text.
// Text in a <pre> element is displayed in a fixed-width font,
// and the text preserves both spaces and line breaks.
// The text will be displayed exactly as written in the HTML source code.

echo ($var1);
echo ($var2);
echo ($var3);

echo ("<br>");

echo ("My number is $var1");
echo ("<br>");
echo ('My number is $var1');
echo ("<br>");
echo ('My number is ' . $var1);

echo ("<br>");

echo ($var1 . "\n");
echo ($var2 . "\n");
echo ($var3 . "\n");

echo ("<pre>");
echo ($var1 . "\n");
echo ($var2 . "\n");
echo ($var3 . "\n");
echo ("</pre>");