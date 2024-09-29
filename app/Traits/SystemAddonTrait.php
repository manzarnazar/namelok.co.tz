<?php

namespace App\Traits;

trait SystemAddonTrait
{
    /**
     * Get the list of addons with their information.
     * 
     * @return array
     */
    public function get_addons(): array
    {
        $dir = 'Modules';
        $directories = $this->getDirectories($dir);

        $addons = [];
        foreach ($directories as $directory) {
            $sub_dirs = $this->getDirectories($dir . '/' . $directory);
            if (in_array('Addon', $sub_dirs)) {
                $addons[] = $dir . '/' . $directory;
            }
        }

        $array = [];
        foreach ($addons as $item) {
            $filePath = $item . '/Addon/info.php';

            // Check if the info.php file exists before including
            if (file_exists($filePath)) {
                $full_data = include($filePath);

                // Ensure 'name', 'software_id', and 'is_published' exist
                if (is_array($full_data) && isset($full_data['name'], $full_data['software_id'], $full_data['is_published'])) {
                    $array[] = [
                        'addon_name' => $full_data['name'],
                        'software_id' => $full_data['software_id'],
                        'is_published' => $full_data['is_published'],
                    ];
                } else {
                    // Log or handle missing keys in the data
                    $array[] = [
                        'addon_name' => 'Unknown',
                        'software_id' => 'Unknown',
                        'is_published' => false,
                    ];
                }
            } else {
                // Handle missing file
                $array[] = [
                    'addon_name' => 'Unknown',
                    'software_id' => 'Unknown',
                    'is_published' => false,
                ];
            }
        }

        return $array;
    }

    /**
     * Get admin routes for published addons.
     * 
     * @return array
     */
    public function get_addon_admin_routes(): array
    {
        $dir = 'Modules';
        $directories = $this->getDirectories($dir);
        $addons = [];

        foreach ($directories as $directory) {
            $sub_dirs = $this->getDirectories($dir . '/' . $directory);
            if (in_array('Addon', $sub_dirs)) {
                $addons[] = $dir . '/' . $directory;
            }
        }

        $full_data = [];
        foreach ($addons as $item) {
            $infoPath = $item . '/Addon/info.php';

            if (file_exists($infoPath)) {
                $info = include($infoPath);

                if ($info['is_published']) {
                    $routesPath = $item . '/Addon/admin_routes.php';

                    // Include the admin routes if the addon is published
                    if (file_exists($routesPath)) {
                        $full_data[] = include($routesPath);
                    }
                }
            }
        }

        return $full_data;
    }

    /**
     * Get the publish status of payment gateways.
     * 
     * @return array
     */
    public function get_payment_publish_status(): array
    {
        $dir = 'Modules/Gateways';
        $directories = $this->getDirectories($dir);

        $addons = [];
        foreach ($directories as $directory) {
            $sub_dirs = $this->getDirectories($dir . '/' . $directory);

            if (in_array('Addon', $sub_dirs)) {
                $addons[] = $dir . '/' . $directory;
            }
        }

        $array = [];
        foreach ($addons as $item) {
            $infoPath = $item . '/Addon/info.php';

            if (file_exists($infoPath)) {
                $full_data = include($infoPath);

                if (isset($full_data['is_published'])) {
                    $array[] = [
                        'is_published' => $full_data['is_published'],
                    ];
                } else {
                    $array[] = [
                        'is_published' => false, // Default if not found
                    ];
                }
            } else {
                $array[] = [
                    'is_published' => false, // Default if file is missing
                ];
            }
        }

        return $array;
    }

    /**
     * Get a list of directories from a given path.
     * 
     * @param string $path
     * @return array
     */
    private function getDirectories(string $path): array
    {
        $directories = [];
        if (is_dir($path)) {
            $items = scandir($path);

            foreach ($items as $item) {
                if ($item == '..' || $item == '.') {
                    continue;
                }

                if (is_dir($path . '/' . $item)) {
                    $directories[] = $item;
                }
            }
        }

        return $directories;
    }
}
