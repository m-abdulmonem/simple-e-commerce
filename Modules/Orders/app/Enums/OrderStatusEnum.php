<?php

namespace Modules\Orders\app\Enums;

/**
 * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
 *
 * CartStatusEnum is a trait that provides the status of a cart.
 *
 * @method static OrderStatusEnum Draft() The cart is in a draft state.
 * @method static OrderStatusEnum Ordered() The cart has been ordered.
 *
 * @package Your\Package\Name
 */
enum OrderStatusEnum :string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

}
