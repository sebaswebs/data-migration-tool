<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Migration\Resource;

/**
 * Resource destination class
 */
class Destination extends AbstractResource
{
    /**
     * Save data into destination resource
     *
     * @param $data
     */
    public function save(array $data)
    {
        foreach($data as $row) {
            $this->resourceAdapter->insert($this->resourceUnitName, $row);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function getResourceConfig(\Migration\Config $configReader)
    {
        $destination = $configReader->getDestination();
        $config['host'] = $destination['database']['host'];
        $config['dbname'] = $destination['database']['name'];
        $config['username'] = $destination['database']['user'];
        $config['password'] = !empty($destination['database']['password'])
            ? $destination['database']['password']
            : '';
        return $config;
    }
}
