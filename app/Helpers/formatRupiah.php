<?php

function rupiah_format($price)
{
    //
    return 'Rp ' . number_format($price, 0, ',', '.');
}
