<?php
/**
 * ICache.php
 * This Interface defines the rules for a class that wants to cache data.
 *
 * @author  Michael Pratt <pratt@hablarmierda.net>
 * @link    http://www.michael-pratt.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace SimpleLifestream\Interfaces;

interface ICache
{
    /**
     * Stores the cache data to a file
     *
     * @param string $key The Identifier key for the file
     * @param mixed $data The data that is going to be saved
     * @param int $ttl The time in seconds that the cache is going to last
     * @return bool True if the cache was saved successfully. False otherwise
     */
    public function store($key, $data, $ttl = 0);

    /**
     * Enables Caching capabilities
     *
     * @return void
     */
    public function enable();

    /**
     * Disables Caching capabilities
     *
     * @return void
     */
    public function disable();

    /**
     * Reads cache data
     *
     * @param string $key the identifier of the cache file
     * @return mixed The cached data or null if it failed
     */
    public function read($key);

    /**
     * Deletes a Cache file based on its key
     *
     * @param string $key the identifier of the cache file
     * @return bool True if the file was deleted, false otherwise
     */
    public function delete($key);

    /**
     * flushes all cache files in $this->location
     *
     * @return int The count of files deleted
     */
    public function flush();
}
?>
