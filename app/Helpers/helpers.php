<?php

if (! function_exists('isSelected')) {
    function isSelected(string $fieldName, $model, $value): ?string
    {
        if(old($fieldName) === (string)$value) {
            return "selected";
        }

        if($model && $model->{$fieldName} == $value) {
            return "selected";
        }

        return null;
    }
}

if (! function_exists('get_product_price')) {
    function get_product_price($price, $discount = 0): float
    {
        return number_format($price - ($price * ($discount/100)), 2,  '.', '');
    }
}

if (! function_exists('product_url')) {
    function product_url($slug): string
    {
        //ToDo add categories
        return url($slug);
    }
}

if (! function_exists('checkStatus')) {
    function checkStatus($order, $status): string
    {

        $in_history_status = $order?->statusHistory->where('status', 2);

        if($in_history_status && $order->status == $status)
            return "active_status";

        if($in_history_status && $order->status > $status)
            return "complete_status";


        return 'salam';
    }
}

if (! function_exists('getStatusDate')) {
    function getStatusDate($order, $status, $format): string
    {
        $date = $order?->statusHistory?->where('status', $status)?->last()?->created_at;
        if(!$date)
            return "-- : --";

        return date_format($date, $format);
    }
}
