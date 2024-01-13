CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
)

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
)

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) 

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_profilePic` mediumblob NOT NULL,
  `username` varchar(255) NOT NULL,
  `customer_firstName` varchar(255) NOT NULL,
  `customer_lastName` varchar(255) NOT NULL,
  `customer_phoneNum` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_postcode` varchar(5) NOT NULL,
  `customer_district` varchar(255) NOT NULL,
  `customer_state` varchar(255) NOT NULL,
  `customer_country` varchar(255) NOT NULL
)

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `track_number` varchar(255) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` enum('pending','shipping','delivered') NOT NULL DEFAULT 'pending',
  `shipping_fee` double(10,2) NOT NULL,
  `tax` double(10,2) NOT NULL
)

CREATE TABLE `order_details` (
  `orderDetail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
)

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `type_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_weight` double(10,2) NOT NULL,
  `product_status` enum('available','locked','unavailable') NOT NULL DEFAULT 'available'
)

CREATE TABLE `product_img` (
  `productImg_id` int(11) NOT NULL,
  `image` mediumblob NOT NULL,
  `product_id` int(11) NOT NULL
)


CREATE TABLE `testimonial` (
  `testimonial_id` int(11) NOT NULL,
  `testimonial_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `testimonial_description` text NOT NULL,
  `customer_id` int(11) NOT NULL
) 


-----------------------------------------------------
SELECT
                o.order_id AS 'Order ID',
                p.product_name AS 'Product Name',
                p.product_description AS 'Product Description',
                o.order_date AS 'Date Sold',
                p.product_price AS 'Price (RM)',
                p.product_weight AS 'Product Weight'
                FROM
                orders o
                JOIN
                customer c ON o.customer_id = c.customer_id
                JOIN
                order_details od ON o.order_id = od.order_id
                JOIN
                product p ON od.product_id = p.product_id
                WHERE o.order_status = 'delivered'
                GROUP BY
                o.order_id
                ORDER BY
                o.order_id ASC