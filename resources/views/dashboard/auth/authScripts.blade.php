<?php
    if (LaravelLocalization::getCurrentLocale() == "ar") {
        $lang = '-rtl' ;
    } else {
        $lang = '' ;
    }
?>

<script src="{{ asset("assets$lang") }}/js/jquery.min.js"></script>
<script src="{{ asset("assets$lang") }}/js/popper.min.js"></script>
<script src="{{ asset("assets$lang") }}/js/bootstrap.min.js"></script>
<script src="{{ asset("assets$lang") }}/js/config.js"></script>
<script src="{{ asset("assets$lang") }}/js/apps.js"></script>