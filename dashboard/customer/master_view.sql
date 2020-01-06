create view master_view as SELECT
    `c`.`id` AS `cust_id`,
    `c`.`name` AS `cust_name`,
    `c`.`phone` AS `cust_phone`,
    `u`.`type` AS `user_type`,
    `u`.`username` AS `user_username`,
    `o`.`id` AS `order_id`,
    `o`.`units` AS `order_units`,
    `o`.`unit_description` AS `order_unit_description`,
    `o`.`cost` AS `order_cost`,
    `p`.`id` AS `product_id`,
    `p`.`name` AS `product_name`,
    `p`.`unit_description` AS `product_product_description`,
    `p`.`available` AS `product_available`,
    `p`.`description` AS `product_description`,
    `p`.`images` AS `images`,
    `p`.`color` AS `color`,
    s.id AS supplier_,
    s.name AS supplier_id,
    s.phone AS supplier_pnone,
    `rs`.`id` AS `ready_id`,
    `rs`.`quantity` AS `rs_quantity`,
    `rs`.`selling_price` AS `read_selling_price`,
    `rs`.`buying_price` AS `ready_buying_price`
FROM
    (
        (
            (
                (
                    (
                        `food`.`customers` `c`
                    JOIN `food`.`users` `u`
                    ON
                        ((`c`.`user_id` = `u`.`id`))
                    )
                JOIN `food`.`orders` `o`
                ON
                    ((`o`.`customer_id` = `c`.`id`))
                )
            JOIN `food`.`products` `p`
            ON
                ((`o`.`product_id` = `p`.`id`))
            )
        JOIN `food`.`suppliers` `s`
        ON
            ((`p`.`supplier_id` = `s`.`id`))
        )
    JOIN `food`.`ready_sale` `rs`
    ON
        ((`rs`.`product_id` = `p`.`id`))
    )