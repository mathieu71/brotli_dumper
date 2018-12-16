<?php 
namespace Drupal\brotli_dumper;

class AssetDumper extends \Drupal\Core\Asset\AssetDumper {
    
    /**
     * {@inheritdoc}
     *
     * The file name for the CSS or JS cache file is generated from the hash of
     * the aggregated contents of the files in $data. This forces proxies and
     * browsers to download new CSS when the CSS changes.
     */
    public function dump($data, $file_extension) {
        $uri = parent::dump($data, $file_extension);

        $file_system = \Drupal::service('file_system');
        $real_source = $file_system->realpath($uri) ?: $uri;
        
        $ret = 0;
        if (!file_exists($uri . '.br')) {
            system("brotli --force -Z ${real_source}", $ret);
            if ($ret !== 0) {
                touch("${$real_source}.failed");
            }
        }
        return $uri;
    }
}
