<?php


use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Modules\Carts\app\Services\CartBaseService;
use Modules\Carts\app\Services\CartDatabaseService;
use Modules\Carts\app\Services\CartSessionService;

if (!function_exists("json")) {

    /**
     * @param mixed $data The data to be included in the response. Default is null.
     * @param string $status The status message to be included in the response. Default is "success".
     * @param string|null $message The message to be included in the response. Default is null.
     * @param int $headerStatus The HTTP status code for the response. Default is 200.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * Returns a JSON response with a specific structure.
     *
     * This function is used to return a JSON response with a specific structure. The structure of the response is an array with keys 'data', 'status', and 'msg'.
     * The 'data' key contains the input data, the 'status' key contains a status message, and the 'msg' key contains a message.
     * The function also allows you to specify the HTTP status code for the response.
     *
     */
    function json(mixed $data = null, string $status = "success", ?string $message = null, int $headerStatus = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => ($isDataNotString = !is_string($data)) ? $data : null,
            'status' => $status,
            'msg' => $isDataNotString ? $message: $data
        ], $headerStatus);
    }
}

if (!function_exists("is_phone")) {

    /**
     * @param mixed $phone The input string to be validated.
     * @return bool Returns true if the input string is a valid phone number, false otherwise.
     * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * Checks if the input string is a valid phone number.
     *
     * This function uses a regular expression to check if the input string is a valid phone number.
     * The regular expression checks if the string starts with an optional '+' sign, followed by a digit from 1 to 9,
     * and then followed by 7 to 14 digits.
     *
     */
    function is_phone(mixed $phone): bool
    {

        return preg_match("/^\\+?[1-9][0-9]{7,14}$/", $phone);
    }
}

if (!function_exists("cartService")) {

    /**
     * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * The cartService method returns an instance of CartBaseService.
     *
     * This method checks the value of the "carts.storage_driver" configuration option.
     * If it equals "database", it returns a new instance of CartDatabaseService.
     * Otherwise, it returns a new instance of CartSessionService.
     *
     * @return CartBaseService An instance of CartBaseService.
     */
    function cartService(): CartBaseService
    {
        return config("carts.storage_driver") == "database"
            ? new CartDatabaseService()
            : new CartSessionService();
    }
}
