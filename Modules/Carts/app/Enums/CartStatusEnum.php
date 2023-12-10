<?php

namespace Modules\Carts\app\Enums;

/**
 * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
 * CartStatusEnum is a trait that provides the status of a cart.
 *
 * @method static CartStatusEnum Draft() The cart is in a draft state.
 * @method static CartStatusEnum Ordered() The cart has been ordered.
 *
 * @package Your\Package\Name
 */
enum CartStatusEnum :string
{
    case Draft = 'draft';
    case Ordered = 'ordered';

}
