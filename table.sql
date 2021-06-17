--
-- Table structure for table `data_order`
--

CREATE TABLE `data_order` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer` text NOT NULL DEFAULT '',
  `payment_status` enum('Unpaid','Fully paid') NOT NULL DEFAULT 'Unpaid',
  `fulfillment_status` enum('Unfulfilled','Fulfilled') NOT NULL DEFAULT 'Unfulfilled',
  `total_amount` double(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_order`
--
ALTER TABLE `data_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_order`
--
ALTER TABLE `data_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;