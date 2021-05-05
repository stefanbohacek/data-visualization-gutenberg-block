<?php
/**
 * Plugin Name: Data Visualization Gutenberg Block
 * Plugin URI: https://github.com/fourtonfish/TBD
 * Description: Add data visualization to your WordPress articles.
 * Version: 0.0.1
 * Author: fourtonfish
 *
 * @package ftf-dataviz-gutenberg-block
 */

defined( 'ABSPATH' ) || exit;

class FTF_Dataviz_Gutenberg_Block {
    public static $width_restriction_small_default = '400';
    public static $width_restriction_medium_default = '720';

    function get_color_palettes( $format = 'php' ){
        $color_palettes = array(
                'Green to yellow' => array(
                    '3' => array_reverse( ["#f7fcb9","#addd8e","#31a354"] ),
                    '4' => array_reverse( ["#ffffcc","#c2e699","#78c679","#238443"] ),
                    '5' => array_reverse( ["#ffffcc","#c2e699","#78c679","#31a354","#006837"] ),
                    '6' => array_reverse( ["#ffffcc","#d9f0a3","#addd8e","#78c679","#31a354","#006837"] ),
                    '7' => array_reverse( ["#ffffcc","#d9f0a3","#addd8e","#78c679","#41ab5d","#238443","#005a32"] ),
                    '8' => array_reverse( ["#ffffe5","#f7fcb9","#d9f0a3","#addd8e","#78c679","#41ab5d","#238443","#005a32"] ),
                    '9' => array_reverse( ["#ffffe5","#f7fcb9","#d9f0a3","#addd8e","#78c679","#41ab5d","#238443","#006837","#004529"] )
                ),
                'Blue-green-yellow' => array(
                    '3' => array_reverse( ["#edf8b1","#7fcdbb","#2c7fb8"] ),
                    '4' => array_reverse( ["#ffffcc","#a1dab4","#41b6c4","#225ea8"] ),
                    '5' => array_reverse( ["#ffffcc","#a1dab4","#41b6c4","#2c7fb8","#253494"] ),
                    '6' => array_reverse( ["#ffffcc","#c7e9b4","#7fcdbb","#41b6c4","#2c7fb8","#253494"] ),
                    '7' => array_reverse( ["#ffffcc","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#0c2c84"] ),
                    '8' => array_reverse( ["#ffffd9","#edf8b1","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#0c2c84"] ),
                    '9' => array_reverse( ["#ffffd9","#edf8b1","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#253494","#081d58"] )
                ),
                'Blue to green' => array(
                    '3' => array_reverse( ["#e0f3db","#a8ddb5","#43a2ca"] ),
                    '4' => array_reverse( ["#f0f9e8","#bae4bc","#7bccc4","#2b8cbe"] ),
                    '5' => array_reverse( ["#f0f9e8","#bae4bc","#7bccc4","#43a2ca","#0868ac"] ),
                    '6' => array_reverse( ["#f0f9e8","#ccebc5","#a8ddb5","#7bccc4","#43a2ca","#0868ac"] ),
                    '7' => array_reverse( ["#f0f9e8","#ccebc5","#a8ddb5","#7bccc4","#4eb3d3","#2b8cbe","#08589e"] ),
                    '8' => array_reverse( ["#f7fcf0","#e0f3db","#ccebc5","#a8ddb5","#7bccc4","#4eb3d3","#2b8cbe","#08589e"] ),
                    '9' => array_reverse( ["#f7fcf0","#e0f3db","#ccebc5","#a8ddb5","#7bccc4","#4eb3d3","#2b8cbe","#0868ac","#084081"] )
                ),
                'Green to blue' => array(
                    '3' => array_reverse( ["#e5f5f9","#99d8c9","#2ca25f"] ),
                    '4' => array_reverse( ["#edf8fb","#b2e2e2","#66c2a4","#238b45"] ),
                    '5' => array_reverse( ["#edf8fb","#b2e2e2","#66c2a4","#2ca25f","#006d2c"] ),
                    '6' => array_reverse( ["#edf8fb","#ccece6","#99d8c9","#66c2a4","#2ca25f","#006d2c"] ),
                    '7' => array_reverse( ["#edf8fb","#ccece6","#99d8c9","#66c2a4","#41ae76","#238b45","#005824"] ),
                    '8' => array_reverse( ["#f7fcfd","#e5f5f9","#ccece6","#99d8c9","#66c2a4","#41ae76","#238b45","#005824"] ),
                    '9' => array_reverse( ["#f7fcfd","#e5f5f9","#ccece6","#99d8c9","#66c2a4","#41ae76","#238b45","#006d2c","#00441b"] )
                ),
                'Green-blue-purple' => array(
                    '3' => array_reverse( ["#ece2f0","#a6bddb","#1c9099"] ),
                    '4' => array_reverse( ["#f6eff7","#bdc9e1","#67a9cf","#02818a"] ),
                    '5' => array_reverse( ["#f6eff7","#bdc9e1","#67a9cf","#1c9099","#016c59"] ),
                    '6' => array_reverse( ["#f6eff7","#d0d1e6","#a6bddb","#67a9cf","#1c9099","#016c59"] ),
                    '7' => array_reverse( ["#f6eff7","#d0d1e6","#a6bddb","#67a9cf","#3690c0","#02818a","#016450"] ),
                    '8' => array_reverse( ["#fff7fb","#ece2f0","#d0d1e6","#a6bddb","#67a9cf","#3690c0","#02818a","#016450"] ),
                    '9' => array_reverse( ["#fff7fb","#ece2f0","#d0d1e6","#a6bddb","#67a9cf","#3690c0","#02818a","#016c59","#014636"] )
                ),
                'Blue to purple' => array(
                    '3' => array_reverse( ["#ece7f2","#a6bddb","#2b8cbe"] ),
                    '4' => array_reverse( ["#f1eef6","#bdc9e1","#74a9cf","#0570b0"] ),
                    '5' => array_reverse( ["#f1eef6","#bdc9e1","#74a9cf","#2b8cbe","#045a8d"] ),
                    '6' => array_reverse( ["#f1eef6","#d0d1e6","#a6bddb","#74a9cf","#2b8cbe","#045a8d"] ),
                    '7' => array_reverse( ["#f1eef6","#d0d1e6","#a6bddb","#74a9cf","#3690c0","#0570b0","#034e7b"] ),
                    '8' => array_reverse( ["#fff7fb","#ece7f2","#d0d1e6","#a6bddb","#74a9cf","#3690c0","#0570b0","#034e7b"] ),
                    '9' => array_reverse( ["#fff7fb","#ece7f2","#d0d1e6","#a6bddb","#74a9cf","#3690c0","#0570b0","#045a8d","#023858"] )
                ),
                'Purple to blue' => array(
                    '3' => array_reverse( ["#e0ecf4","#9ebcda","#8856a7"] ),
                    '4' => array_reverse( ["#edf8fb","#b3cde3","#8c96c6","#88419d"] ),
                    '5' => array_reverse( ["#edf8fb","#b3cde3","#8c96c6","#8856a7","#810f7c"] ),
                    '6' => array_reverse( ["#edf8fb","#bfd3e6","#9ebcda","#8c96c6","#8856a7","#810f7c"] ),
                    '7' => array_reverse( ["#edf8fb","#bfd3e6","#9ebcda","#8c96c6","#8c6bb1","#88419d","#6e016b"] ),
                    '8' => array_reverse( ["#f7fcfd","#e0ecf4","#bfd3e6","#9ebcda","#8c96c6","#8c6bb1","#88419d","#6e016b"] ),
                    '9' => array_reverse( ["#f7fcfd","#e0ecf4","#bfd3e6","#9ebcda","#8c96c6","#8c6bb1","#88419d","#810f7c","#4d004b"] )
                ),
                'Purple to red' => array(
                    '3' => array_reverse( ["#fde0dd","#fa9fb5","#c51b8a"] ),
                    '4' => array_reverse( ["#feebe2","#fbb4b9","#f768a1","#ae017e"] ),
                    '5' => array_reverse( ["#feebe2","#fbb4b9","#f768a1","#c51b8a","#7a0177"] ),
                    '6' => array_reverse( ["#feebe2","#fcc5c0","#fa9fb5","#f768a1","#c51b8a","#7a0177"] ),
                    '7' => array_reverse( ["#feebe2","#fcc5c0","#fa9fb5","#f768a1","#dd3497","#ae017e","#7a0177"] ),
                    '8' => array_reverse( ["#fff7f3","#fde0dd","#fcc5c0","#fa9fb5","#f768a1","#dd3497","#ae017e","#7a0177"] ),
                    '9' => array_reverse( ["#fff7f3","#fde0dd","#fcc5c0","#fa9fb5","#f768a1","#dd3497","#ae017e","#7a0177","#49006a"] )
                ),
                'Red to purple' => array(
                    '3' => array_reverse( ["#e7e1ef","#c994c7","#dd1c77"] ),
                    '4' => array_reverse( ["#f1eef6","#d7b5d8","#df65b0","#ce1256"] ),
                    '5' => array_reverse( ["#f1eef6","#d7b5d8","#df65b0","#dd1c77","#980043"] ),
                    '6' => array_reverse( ["#f1eef6","#d4b9da","#c994c7","#df65b0","#dd1c77","#980043"] ),
                    '7' => array_reverse( ["#f1eef6","#d4b9da","#c994c7","#df65b0","#e7298a","#ce1256","#91003f"] ),
                    '8' => array_reverse( ["#f7f4f9","#e7e1ef","#d4b9da","#c994c7","#df65b0","#e7298a","#ce1256","#91003f"] ),
                    '9' => array_reverse( ["#f7f4f9","#e7e1ef","#d4b9da","#c994c7","#df65b0","#e7298a","#ce1256","#980043","#67001f"] )
                ),
                'Red to orange' => array(
                    '3' => array_reverse( ["#fee8c8","#fdbb84","#e34a33"] ),
                    '4' => array_reverse( ["#fef0d9","#fdcc8a","#fc8d59","#d7301f"] ),
                    '5' => array_reverse( ["#fef0d9","#fdcc8a","#fc8d59","#e34a33","#b30000"] ),
                    '6' => array_reverse( ["#fef0d9","#fdd49e","#fdbb84","#fc8d59","#e34a33","#b30000"] ),
                    '7' => array_reverse( ["#fef0d9","#fdd49e","#fdbb84","#fc8d59","#ef6548","#d7301f","#990000"] ),
                    '8' => array_reverse( ["#fff7ec","#fee8c8","#fdd49e","#fdbb84","#fc8d59","#ef6548","#d7301f","#990000"] ),
                    '9' => array_reverse( ["#fff7ec","#fee8c8","#fdd49e","#fdbb84","#fc8d59","#ef6548","#d7301f","#b30000","#7f0000"] )
                ),
                'Red-orange-yellow' => array(
                    '3' => array_reverse( ["#ffeda0","#feb24c","#f03b20"] ),
                    '4' => array_reverse( ["#ffffb2","#fecc5c","#fd8d3c","#e31a1c"] ),
                    '5' => array_reverse( ["#ffffb2","#fecc5c","#fd8d3c","#f03b20","#bd0026"] ),
                    '6' => array_reverse( ["#ffffb2","#fed976","#feb24c","#fd8d3c","#f03b20","#bd0026"] ),
                    '7' => array_reverse( ["#ffffb2","#fed976","#feb24c","#fd8d3c","#fc4e2a","#e31a1c","#b10026"] ),
                    '8' => array_reverse( ["#ffffcc","#ffeda0","#fed976","#feb24c","#fd8d3c","#fc4e2a","#e31a1c","#b10026"] ),
                    '9' => array_reverse( ["#ffffcc","#ffeda0","#fed976","#feb24c","#fd8d3c","#fc4e2a","#e31a1c","#bd0026","#800026"] )
                ),
                'Brown-orange-yellow' => array(
                    '3' => array_reverse( ["#fff7bc","#fec44f","#d95f0e"] ),
                    '4' => array_reverse( ["#ffffd4","#fed98e","#fe9929","#cc4c02"] ),
                    '5' => array_reverse( ["#ffffd4","#fed98e","#fe9929","#d95f0e","#993404"] ),
                    '6' => array_reverse( ["#ffffd4","#fee391","#fec44f","#fe9929","#d95f0e","#993404"] ),
                    '7' => array_reverse( ["#ffffd4","#fee391","#fec44f","#fe9929","#ec7014","#cc4c02","#8c2d04"] ),
                    '8' => array_reverse( ["#ffffe5","#fff7bc","#fee391","#fec44f","#fe9929","#ec7014","#cc4c02","#8c2d04"] ),
                    '9' => array_reverse( ["#ffffe5","#fff7bc","#fee391","#fec44f","#fe9929","#ec7014","#cc4c02","#993404","#662506"] )
                ),
                'Purples' => array(
                    '3' => array_reverse( ["#efedf5","#bcbddc","#756bb1"] ),
                    '4' => array_reverse( ["#f2f0f7","#cbc9e2","#9e9ac8","#6a51a3"] ),
                    '5' => array_reverse( ["#f2f0f7","#cbc9e2","#9e9ac8","#756bb1","#54278f"] ),
                    '6' => array_reverse( ["#f2f0f7","#dadaeb","#bcbddc","#9e9ac8","#756bb1","#54278f"] ),
                    '7' => array_reverse( ["#f2f0f7","#dadaeb","#bcbddc","#9e9ac8","#807dba","#6a51a3","#4a1486"] ),
                    '8' => array_reverse( ["#fcfbfd","#efedf5","#dadaeb","#bcbddc","#9e9ac8","#807dba","#6a51a3","#4a1486"] ),
                    '9' => array_reverse( ["#fcfbfd","#efedf5","#dadaeb","#bcbddc","#9e9ac8","#807dba","#6a51a3","#54278f","#3f007d"] )
                ),
                'Blues' => array(
                    '3' => array_reverse( ["#deebf7","#9ecae1","#3182bd"] ),
                    '4' => array_reverse( ["#eff3ff","#bdd7e7","#6baed6","#2171b5"] ),
                    '5' => array_reverse( ["#eff3ff","#bdd7e7","#6baed6","#3182bd","#08519c"] ),
                    '6' => array_reverse( ["#eff3ff","#c6dbef","#9ecae1","#6baed6","#3182bd","#08519c"] ),
                    '7' => array_reverse( ["#eff3ff","#c6dbef","#9ecae1","#6baed6","#4292c6","#2171b5","#084594"] ),
                    '8' => array_reverse( ["#f7fbff","#deebf7","#c6dbef","#9ecae1","#6baed6","#4292c6","#2171b5","#084594"] ),
                    '9' => array_reverse( ["#f7fbff","#deebf7","#c6dbef","#9ecae1","#6baed6","#4292c6","#2171b5","#08519c","#08306b"] )
                ),
                'Greens' => array(
                    '3' => array_reverse( ["#e5f5e0","#a1d99b","#31a354"] ),
                    '4' => array_reverse( ["#edf8e9","#bae4b3","#74c476","#238b45"] ),
                    '5' => array_reverse( ["#edf8e9","#bae4b3","#74c476","#31a354","#006d2c"] ),
                    '6' => array_reverse( ["#edf8e9","#c7e9c0","#a1d99b","#74c476","#31a354","#006d2c"] ),
                    '7' => array_reverse( ["#edf8e9","#c7e9c0","#a1d99b","#74c476","#41ab5d","#238b45","#005a32"] ),
                    '8' => array_reverse( ["#f7fcf5","#e5f5e0","#c7e9c0","#a1d99b","#74c476","#41ab5d","#238b45","#005a32"] ),
                    '9' => array_reverse( ["#f7fcf5","#e5f5e0","#c7e9c0","#a1d99b","#74c476","#41ab5d","#238b45","#006d2c","#00441b"] )
                ),
                'Oranges' => array(
                    '3' => array_reverse( ["#fee6ce","#fdae6b","#e6550d"] ),
                    '4' => array_reverse( ["#feedde","#fdbe85","#fd8d3c","#d94701"] ),
                    '5' => array_reverse( ["#feedde","#fdbe85","#fd8d3c","#e6550d","#a63603"] ),
                    '6' => array_reverse( ["#feedde","#fdd0a2","#fdae6b","#fd8d3c","#e6550d","#a63603"] ),
                    '7' => array_reverse( ["#feedde","#fdd0a2","#fdae6b","#fd8d3c","#f16913","#d94801","#8c2d04"] ),
                    '8' => array_reverse( ["#fff5eb","#fee6ce","#fdd0a2","#fdae6b","#fd8d3c","#f16913","#d94801","#8c2d04"] ),
                    '9' => array_reverse( ["#fff5eb","#fee6ce","#fdd0a2","#fdae6b","#fd8d3c","#f16913","#d94801","#a63603","#7f2704"] )
                ),
                'Reds' => array(
                    '3' => array_reverse( ["#fee0d2","#fc9272","#de2d26"] ),
                    '4' => array_reverse( ["#fee5d9","#fcae91","#fb6a4a","#cb181d"] ),
                    '5' => array_reverse( ["#fee5d9","#fcae91","#fb6a4a","#de2d26","#a50f15"] ),
                    '6' => array_reverse( ["#fee5d9","#fcbba1","#fc9272","#fb6a4a","#de2d26","#a50f15"] ),
                    '7' => array_reverse( ["#fee5d9","#fcbba1","#fc9272","#fb6a4a","#ef3b2c","#cb181d","#99000d"] ),
                    '8' => array_reverse( ["#fff5f0","#fee0d2","#fcbba1","#fc9272","#fb6a4a","#ef3b2c","#cb181d","#99000d"] ),
                    '9' => array_reverse( ["#fff5f0","#fee0d2","#fcbba1","#fc9272","#fb6a4a","#ef3b2c","#cb181d","#a50f15","#67000d"] )
                ),
                'Grays' => array(
                    '3' => array_reverse( ["#f0f0f0","#bdbdbd","#636363"] ),
                    '4' => array_reverse( ["#f7f7f7","#cccccc","#969696","#525252"] ),
                    '5' => array_reverse( ["#f7f7f7","#cccccc","#969696","#636363","#252525"] ),
                    '6' => array_reverse( ["#f7f7f7","#d9d9d9","#bdbdbd","#969696","#636363","#252525"] ),
                    '7' => array_reverse( ["#f7f7f7","#d9d9d9","#bdbdbd","#969696","#737373","#525252","#252525"] ),
                    '8' => array_reverse( ["#ffffff","#f0f0f0","#d9d9d9","#bdbdbd","#969696","#737373","#525252","#252525"] ),
                    '9' => array_reverse( ["#ffffff","#f0f0f0","#d9d9d9","#bdbdbd","#969696","#737373","#525252","#252525","#000000"] )
                ),
                'Purple to orange' => array(
                    '3' => array_reverse( ["#f1a340","#f7f7f7","#998ec3"] ),
                    '4' => array_reverse( ["#e66101","#fdb863","#b2abd2","#5e3c99"] ),
                    '5' => array_reverse( ["#e66101","#fdb863","#f7f7f7","#b2abd2","#5e3c99"] ),
                    '6' => array_reverse( ["#b35806","#f1a340","#fee0b6","#d8daeb","#998ec3","#542788"] ),
                    '7' => array_reverse( ["#b35806","#f1a340","#fee0b6","#f7f7f7","#d8daeb","#998ec3","#542788"] ),
                    '8' => array_reverse( ["#b35806","#e08214","#fdb863","#fee0b6","#d8daeb","#b2abd2","#8073ac","#542788"] ),
                    '9' => array_reverse( ["#b35806","#e08214","#fdb863","#fee0b6","#f7f7f7","#d8daeb","#b2abd2","#8073ac","#542788"] ),
                    '10' => array_reverse( ["#7f3b08","#b35806","#e08214","#fdb863","#fee0b6","#d8daeb","#b2abd2","#8073ac","#542788","#2d004b"] ),
                    '11' => array_reverse( ["#7f3b08","#b35806","#e08214","#fdb863","#fee0b6","#f7f7f7","#d8daeb","#b2abd2","#8073ac","#542788","#2d004b"] )
                ),
                'Green to brown' => array(
                    '3' => array_reverse( ["#d8b365","#f5f5f5","#5ab4ac"] ),
                    '4' => array_reverse( ["#a6611a","#dfc27d","#80cdc1","#018571"] ),
                    '5' => array_reverse( ["#a6611a","#dfc27d","#f5f5f5","#80cdc1","#018571"] ),
                    '6' => array_reverse( ["#8c510a","#d8b365","#f6e8c3","#c7eae5","#5ab4ac","#01665e"] ),
                    '7' => array_reverse( ["#8c510a","#d8b365","#f6e8c3","#f5f5f5","#c7eae5","#5ab4ac","#01665e"] ),
                    '8' => array_reverse( ["#8c510a","#bf812d","#dfc27d","#f6e8c3","#c7eae5","#80cdc1","#35978f","#01665e"] ),
                    '9' => array_reverse( ["#8c510a","#bf812d","#dfc27d","#f6e8c3","#f5f5f5","#c7eae5","#80cdc1","#35978f","#01665e"] ),
                    '10' => array_reverse( ["#543005","#8c510a","#bf812d","#dfc27d","#f6e8c3","#c7eae5","#80cdc1","#35978f","#01665e","#003c30"] ),
                    '11' => array_reverse( ["#543005","#8c510a","#bf812d","#dfc27d","#f6e8c3","#f5f5f5","#c7eae5","#80cdc1","#35978f","#01665e","#003c30"] )
                ),
                'Purple to green' => array(
                    '3' => array_reverse( ["#af8dc3","#f7f7f7","#7fbf7b"] ),
                    '4' => array_reverse( ["#7b3294","#c2a5cf","#a6dba0","#008837"] ),
                    '5' => array_reverse( ["#7b3294","#c2a5cf","#f7f7f7","#a6dba0","#008837"] ),
                    '6' => array_reverse( ["#762a83","#af8dc3","#e7d4e8","#d9f0d3","#7fbf7b","#1b7837"] ),
                    '7' => array_reverse( ["#762a83","#af8dc3","#e7d4e8","#f7f7f7","#d9f0d3","#7fbf7b","#1b7837"] ),
                    '8' => array_reverse( ["#762a83","#9970ab","#c2a5cf","#e7d4e8","#d9f0d3","#a6dba0","#5aae61","#1b7837"] ),
                    '9' => array_reverse( ["#762a83","#9970ab","#c2a5cf","#e7d4e8","#f7f7f7","#d9f0d3","#a6dba0","#5aae61","#1b7837"] ),
                    '10' => array_reverse( ["#40004b","#762a83","#9970ab","#c2a5cf","#e7d4e8","#d9f0d3","#a6dba0","#5aae61","#1b7837","#00441b"] ),
                    '11' => array_reverse( ["#40004b","#762a83","#9970ab","#c2a5cf","#e7d4e8","#f7f7f7","#d9f0d3","#a6dba0","#5aae61","#1b7837","#00441b"] )
                ),
                'Purple to light green' => array(
                    '3' => array_reverse( ["#e9a3c9","#f7f7f7","#a1d76a"] ),
                    '4' => array_reverse( ["#d01c8b","#f1b6da","#b8e186","#4dac26"] ),
                    '5' => array_reverse( ["#d01c8b","#f1b6da","#f7f7f7","#b8e186","#4dac26"] ),
                    '6' => array_reverse( ["#c51b7d","#e9a3c9","#fde0ef","#e6f5d0","#a1d76a","#4d9221"] ),
                    '7' => array_reverse( ["#c51b7d","#e9a3c9","#fde0ef","#f7f7f7","#e6f5d0","#a1d76a","#4d9221"] ),
                    '8' => array_reverse( ["#c51b7d","#de77ae","#f1b6da","#fde0ef","#e6f5d0","#b8e186","#7fbc41","#4d9221"] ),
                    '9' => array_reverse( ["#c51b7d","#de77ae","#f1b6da","#fde0ef","#f7f7f7","#e6f5d0","#b8e186","#7fbc41","#4d9221"] ),
                    '10' => array_reverse( ["#8e0152","#c51b7d","#de77ae","#f1b6da","#fde0ef","#e6f5d0","#b8e186","#7fbc41","#4d9221","#276419"] ),
                    '11' => array_reverse( ["#8e0152","#c51b7d","#de77ae","#f1b6da","#fde0ef","#f7f7f7","#e6f5d0","#b8e186","#7fbc41","#4d9221","#276419"] )
                ),
                'Blue to red' => array(
                    '3' => array_reverse( ["#ef8a62","#f7f7f7","#67a9cf"] ),
                    '4' => array_reverse( ["#ca0020","#f4a582","#92c5de","#0571b0"] ),
                    '5' => array_reverse( ["#ca0020","#f4a582","#f7f7f7","#92c5de","#0571b0"] ),
                    '6' => array_reverse( ["#b2182b","#ef8a62","#fddbc7","#d1e5f0","#67a9cf","#2166ac"] ),
                    '7' => array_reverse( ["#b2182b","#ef8a62","#fddbc7","#f7f7f7","#d1e5f0","#67a9cf","#2166ac"] ),
                    '8' => array_reverse( ["#b2182b","#d6604d","#f4a582","#fddbc7","#d1e5f0","#92c5de","#4393c3","#2166ac"] ),
                    '9' => array_reverse( ["#b2182b","#d6604d","#f4a582","#fddbc7","#f7f7f7","#d1e5f0","#92c5de","#4393c3","#2166ac"] ),
                    '10' => array_reverse( ["#67001f","#b2182b","#d6604d","#f4a582","#fddbc7","#d1e5f0","#92c5de","#4393c3","#2166ac","#053061"] ),
                    '11' => array_reverse( ["#67001f","#b2182b","#d6604d","#f4a582","#fddbc7","#f7f7f7","#d1e5f0","#92c5de","#4393c3","#2166ac","#053061"] )
                ),
                'Gray to red' => array(
                    '3' => array_reverse( ["#ef8a62","#ffffff","#999999"] ),
                    '4' => array_reverse( ["#ca0020","#f4a582","#bababa","#404040"] ),
                    '5' => array_reverse( ["#ca0020","#f4a582","#ffffff","#bababa","#404040"] ),
                    '6' => array_reverse( ["#b2182b","#ef8a62","#fddbc7","#e0e0e0","#999999","#4d4d4d"] ),
                    '7' => array_reverse( ["#b2182b","#ef8a62","#fddbc7","#ffffff","#e0e0e0","#999999","#4d4d4d"] ),
                    '8' => array_reverse( ["#b2182b","#d6604d","#f4a582","#fddbc7","#e0e0e0","#bababa","#878787","#4d4d4d"] ),
                    '9' => array_reverse( ["#b2182b","#d6604d","#f4a582","#fddbc7","#ffffff","#e0e0e0","#bababa","#878787","#4d4d4d"] ),
                    '10' => array_reverse( ["#67001f","#b2182b","#d6604d","#f4a582","#fddbc7","#e0e0e0","#bababa","#878787","#4d4d4d","#1a1a1a"] ),
                    '11' => array_reverse( ["#67001f","#b2182b","#d6604d","#f4a582","#fddbc7","#ffffff","#e0e0e0","#bababa","#878787","#4d4d4d","#1a1a1a"] )
                ),
                'Blue-yellow-red' => array(
                    '3' => array_reverse( ["#fc8d59","#ffffbf","#91bfdb"] ),
                    '4' => array_reverse( ["#d7191c","#fdae61","#abd9e9","#2c7bb6"] ),
                    '5' => array_reverse( ["#d7191c","#fdae61","#ffffbf","#abd9e9","#2c7bb6"] ),
                    '6' => array_reverse( ["#d73027","#fc8d59","#fee090","#e0f3f8","#91bfdb","#4575b4"] ),
                    '7' => array_reverse( ["#d73027","#fc8d59","#fee090","#ffffbf","#e0f3f8","#91bfdb","#4575b4"] ),
                    '8' => array_reverse( ["#d73027","#f46d43","#fdae61","#fee090","#e0f3f8","#abd9e9","#74add1","#4575b4"] ),
                    '9' => array_reverse( ["#d73027","#f46d43","#fdae61","#fee090","#ffffbf","#e0f3f8","#abd9e9","#74add1","#4575b4"] ),
                    '10' => array_reverse( ["#a50026","#d73027","#f46d43","#fdae61","#fee090","#e0f3f8","#abd9e9","#74add1","#4575b4","#313695"] ),
                    '11' => array_reverse( ["#a50026","#d73027","#f46d43","#fdae61","#fee090","#ffffbf","#e0f3f8","#abd9e9","#74add1","#4575b4","#313695"] )
                ),
                'Spectral' => array(
                    '3' => array_reverse( ["#fc8d59","#ffffbf","#99d594"] ),
                    '4' => array_reverse( ["#d7191c","#fdae61","#abdda4","#2b83ba"] ),
                    '5' => array_reverse( ["#d7191c","#fdae61","#ffffbf","#abdda4","#2b83ba"] ),
                    '6' => array_reverse( ["#d53e4f","#fc8d59","#fee08b","#e6f598","#99d594","#3288bd"] ),
                    '7' => array_reverse( ["#d53e4f","#fc8d59","#fee08b","#ffffbf","#e6f598","#99d594","#3288bd"] ),
                    '8' => array_reverse( ["#d53e4f","#f46d43","#fdae61","#fee08b","#e6f598","#abdda4","#66c2a5","#3288bd"] ),
                    '9' => array_reverse( ["#d53e4f","#f46d43","#fdae61","#fee08b","#ffffbf","#e6f598","#abdda4","#66c2a5","#3288bd"] ),
                    '10' => array_reverse( ["#9e0142","#d53e4f","#f46d43","#fdae61","#fee08b","#e6f598","#abdda4","#66c2a5","#3288bd","#5e4fa2"] ),
                    '11' => array_reverse( ["#9e0142","#d53e4f","#f46d43","#fdae61","#fee08b","#ffffbf","#e6f598","#abdda4","#66c2a5","#3288bd","#5e4fa2"] )
                ),
                'Green-yellow-red' => array(
                    '3' => array_reverse( ["#fc8d59","#ffffbf","#91cf60"] ),
                    '4' => array_reverse( ["#d7191c","#fdae61","#a6d96a","#1a9641"] ),
                    '5' => array_reverse( ["#d7191c","#fdae61","#ffffbf","#a6d96a","#1a9641"] ),
                    '6' => array_reverse( ["#d73027","#fc8d59","#fee08b","#d9ef8b","#91cf60","#1a9850"] ),
                    '7' => array_reverse( ["#d73027","#fc8d59","#fee08b","#ffffbf","#d9ef8b","#91cf60","#1a9850"] ),
                    '8' => array_reverse( ["#d73027","#f46d43","#fdae61","#fee08b","#d9ef8b","#a6d96a","#66bd63","#1a9850"] ),
                    '9' => array_reverse( ["#d73027","#f46d43","#fdae61","#fee08b","#ffffbf","#d9ef8b","#a6d96a","#66bd63","#1a9850"] ),
                    '10' => array_reverse( ["#a50026","#d73027","#f46d43","#fdae61","#fee08b","#d9ef8b","#a6d96a","#66bd63","#1a9850","#006837"] ),
                    '11' => array_reverse( ["#a50026","#d73027","#f46d43","#fdae61","#fee08b","#ffffbf","#d9ef8b","#a6d96a","#66bd63","#1a9850","#006837"] )
                ),
                'Accent' => array(
                    '3' => array_reverse( ["#7fc97f","#beaed4","#fdc086"] ),
                    '4' => array_reverse( ["#7fc97f","#beaed4","#fdc086","#ffff99"] ),
                    '5' => array_reverse( ["#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0"] ),
                    '6' => array_reverse( ["#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0","#f0027f"] ),
                    '7' => array_reverse( ["#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0","#f0027f","#bf5b17"] ),
                    '8' => array_reverse( ["#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0","#f0027f","#bf5b17","#666666"] )
                ),
                'Dark' => array(
                    '3' => array_reverse( ["#1b9e77","#d95f02","#7570b3"] ),
                    '4' => array_reverse( ["#1b9e77","#d95f02","#7570b3","#e7298a"] ),
                    '5' => array_reverse( ["#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e"] ),
                    '6' => array_reverse( ["#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e","#e6ab02"] ),
                    '7' => array_reverse( ["#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e","#e6ab02","#a6761d"] ),
                    '8' => array_reverse( ["#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e","#e6ab02","#a6761d","#666666"] )
                ),
                'Paired' => array(
                    '3' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a"] ),
                    '4' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c"] ),
                    '5' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99"] ),
                    '6' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c"] ),
                    '7' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f"] ),
                    '8' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00"] ),
                    '9' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00","#cab2d6"] ),
                    '10' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00","#cab2d6","#6a3d9a"] ),
                    '11' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00","#cab2d6","#6a3d9a","#ffff99"] ),
                    '12' => array_reverse( ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00","#cab2d6","#6a3d9a","#ffff99","#b15928"] )
                ),
                'Pastel 1' => array(
                    '3' => array_reverse( ["#fbb4ae","#b3cde3","#ccebc5"] ),
                    '4' => array_reverse( ["#fbb4ae","#b3cde3","#ccebc5","#decbe4"] ),
                    '5' => array_reverse( ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6"] ),
                    '6' => array_reverse( ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6","#ffffcc"] ),
                    '7' => array_reverse( ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6","#ffffcc","#e5d8bd"] ),
                    '8' => array_reverse( ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6","#ffffcc","#e5d8bd","#fddaec"] ),
                    '9' => array_reverse( ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6","#ffffcc","#e5d8bd","#fddaec","#f2f2f2"] )
                ),
                'Pastel 2' => array(
                    '3' => array_reverse( ["#b3e2cd","#fdcdac","#cbd5e8"] ),
                    '4' => array_reverse( ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4"] ),
                    '5' => array_reverse( ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4","#e6f5c9"] ),
                    '6' => array_reverse( ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4","#e6f5c9","#fff2ae"] ),
                    '7' => array_reverse( ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4","#e6f5c9","#fff2ae","#f1e2cc"] ),
                    '8' => array_reverse( ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4","#e6f5c9","#fff2ae","#f1e2cc","#cccccc"] )
                ),
                'Set 1' => array(
                    '3' => array_reverse( ["#e41a1c","#377eb8","#4daf4a"] ),
                    '4' => array_reverse( ["#e41a1c","#377eb8","#4daf4a","#984ea3"] ),
                    '5' => array_reverse( ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00"] ),
                    '6' => array_reverse( ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00","#ffff33"] ),
                    '7' => array_reverse( ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00","#ffff33","#a65628"] ),
                    '8' => array_reverse( ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00","#ffff33","#a65628","#f781bf"] ),
                    '9' => array_reverse( ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00","#ffff33","#a65628","#f781bf","#999999"] )
                ),
                'Set 2' => array(
                    '3' => array_reverse( ["#66c2a5","#fc8d62","#8da0cb"] ),
                    '4' => array_reverse( ["#66c2a5","#fc8d62","#8da0cb","#e78ac3"] ),
                    '5' => array_reverse( ["#66c2a5","#fc8d62","#8da0cb","#e78ac3","#a6d854"] ),
                    '6' => array_reverse( ["#66c2a5","#fc8d62","#8da0cb","#e78ac3","#a6d854","#ffd92f"] ),
                    '7' => array_reverse( ["#66c2a5","#fc8d62","#8da0cb","#e78ac3","#a6d854","#ffd92f","#e5c494"] ),
                    '8' => array_reverse( ["#66c2a5","#fc8d62","#8da0cb","#e78ac3","#a6d854","#ffd92f","#e5c494","#b3b3b3"] )
                ),
                'Set 3' => array(
                    '3' => array_reverse( ["#8dd3c7","#ffffb3","#bebada"] ),
                    '4' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072"] ),
                    '5' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3"] ),
                    '6' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462"] ),
                    '7' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69"] ),
                    '8' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5"] ),
                    '9' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5","#d9d9d9"] ),
                    '10' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5","#d9d9d9","#bc80bd"] ),
                    '11' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5","#d9d9d9","#bc80bd","#ccebc5"] ),
                    '12' => array_reverse( ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5","#d9d9d9","#bc80bd","#ccebc5","#ffed6f"] )
            ) );

            $color_palettes_json = json_encode( $color_palettes );

            $color_palettes_html = <<<SCRIPT
                var ftfHelpers = ftfHelpers || {};
                // This product includes color specifications and designs developed by Cynthia Brewer (http://colorbrewer.org/).
                // JavaScript specs as packaged in the D3 library (d3js.org). Please see license at http://colorbrewer.org/export/LICENSE.txt
                ftfHelpers.colorPalettes = ${color_palettes_json};
SCRIPT;
        switch ( $format ) {
            case 'json':
                return $color_palettes_json;
                break;        
            case 'html':
                return $color_palettes_html;
                break;        
            default:
                return $color_palettes;
                break;
        }
    }
    

    function __construct(){
        add_action( 'init', array( $this, 'register_block' ) );
        add_action( 'enqueue_block_assets', array( $this, 'enqueue_scripts_and_styles' ) );
        add_action( 'wp_footer', array( $this, 'add_inline_scripts' ) );        
        // add_action( 'admin_init', array( $this, 'enqueue_scripts_and_styles_admin' ) );
        add_action( 'admin_init', array( $this, 'settings_init' ) );
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_filter( 'plugin_action_links_dataviz-gutenberg-block/index.php', array( $this, 'settings_page_link' ) );
        add_action( 'wp_ajax_get_data', array( $this, 'get_data_ajax' ), 1000 );
        add_action( 'wp_ajax_get_svg_map_html', array( $this, 'get_svg_map_html_ajax' ), 1000 );
    }

    function register_block(){
        $asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');

        wp_register_script(
            'ftf-dataviz',
            plugins_url( 'build/index.js', __FILE__ ),
            $asset_file['dependencies'],
            $asset_file['version']
        );

        wp_register_style(
            'ftf-dataviz-editor',
            plugins_url( 'editor.css', __FILE__ ),
            array( 'wp-edit-blocks' ),
            filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
        );

        register_block_type( 'ftf/dataviz-gutenberg-block', array(
            'style' => 'ftf-dataviz',
            'editor_style' => 'ftf-dataviz-editor',
            'editor_script' => 'ftf-dataviz',
            'render_callback' => array( $this, 'render_callback' )
        ) );

        wp_add_inline_script( 'ftf-dataviz', self::get_color_palettes( 'html' ) );
    }


    function get_us_state_code( $state ){
        $state_name_or_code = trim( strtolower( $state ) );
        $state_code = '';

        switch ( $state_name_or_code ) {
            case 'alabama':
            case 'al':
                $state_code = 'AL';
                break;
            case 'alaska':
            case 'ak':
                $state_code = 'AK';
                break;
            case 'arizona':
            case 'az':
                $state_code = 'AZ';
                break;
            case 'arkansas':
            case 'ar':
                $state_code = 'AR';
                break;
            case 'california':
            case 'ca':
                $state_code = 'CA';
                break;
            case 'colorado':
            case 'co':
                $state_code = 'CO';
                break;
            case 'connecticut':
            case 'ct':
                $state_code = 'CT';
                break;
            case 'delaware':
            case 'de':
                $state_code = 'DE';
                break;
            case 'district of columbia':
            case 'dc':
                $state_code = 'DC';
                break;
            case 'florida':
            case 'fl':
                $state_code = 'FL';
                break;
            case 'georgia':
            case 'ga':
                $state_code = 'GA';
                break;
            case 'hawaii':
            case 'hi':
                $state_code = 'HI';
                break;
            case 'idaho':
            case 'id':
                $state_code = 'ID';
                break;
            case 'illinois':
            case 'il':
                $state_code = 'IL';
                break;
            case 'indiana':
            case 'in':
                $state_code = 'IN';
                break;
            case 'iowa':
            case 'ia':
                $state_code = 'IA';
                break;
            case 'kansas':
            case 'ks':
                $state_code = 'KS';
                break;
            case 'kentucky':
            case 'ky':
                $state_code = 'KY';
                break;
            case 'louisiana':
            case 'la':
                $state_code = 'LA';
                break;
            case 'maine':
            case 'me':
                $state_code = 'ME';
                break;
            case 'montana':
            case 'mt':
                $state_code = 'MT';
                break;
            case 'nebraska':
            case 'ne':
                $state_code = 'NE';
                break;
            case 'nevada':
            case 'nv':
                $state_code = 'NV';
                break;
            case 'new hampshire':
            case 'nh':
                $state_code = 'NH';
                break;
            case 'new jersey':
            case 'nj':
                $state_code = 'NJ';
                break;
            case 'new mexico':
            case 'nm':
                $state_code = 'NM';
                break;
            case 'new york':
            case 'ny':
                $state_code = 'NY';
                break;
            case 'north carolina':
            case 'nc':
                $state_code = 'NC';
                break;
            case 'north dakota':
            case 'nd':
                $state_code = 'ND';
                break;
            case 'ohio':
            case 'oh':
                $state_code = 'OH';
                break;
            case 'oklahoma':
            case 'ok':
                $state_code = 'OK';
                break;
            case 'oregon':
            case 'or':
                $state_code = 'OR';
                break;
            case 'maryland':
            case 'md':
                $state_code = 'MD';
                break;
            case 'massachusetts':
            case 'ma':
                $state_code = 'MA';
                break;
            case 'michigan':
            case 'mi':
                $state_code = 'MI';
                break;
            case 'minnesota':
            case 'mn':
                $state_code = 'MN';
                break;
            case 'mississippi':
            case 'ms':
                $state_code = 'MS';
                break;
            case 'missouri':
            case 'mo':
                $state_code = 'MO';
                break;
            case 'pennsylvania':
            case 'pa':
                $state_code = 'PA';
                break;
            case 'rhode island':
            case 'ri':
                $state_code = 'RI';
                break;
            case 'south carolina':
            case 'sc':
                $state_code = 'SC';
                break;
            case 'south dakota':
            case 'sd':
                $state_code = 'SD';
                break;
            case 'tennessee':
            case 'tn':
                $state_code = 'TN';
                break;
            case 'texas':
            case 'tx':
                $state_code = 'TX';
                break;
            case 'utah':
            case 'ut':
                $state_code = 'UT';
                break;
            case 'vermont':
            case 'vt':
                $state_code = 'VT';
                break;
            case 'virginia':
            case 'va':
                $state_code = 'VA';
                break;
            case 'washington':
            case 'wa':
                $state_code = 'WA';
                break;
            case 'west virginia':
            case 'wv':
                $state_code = 'WV';
                break;
            case 'wisconsin':
            case 'wi':
                $state_code = 'WI';
                break;
            case 'wyoming':
            case 'wy':
                $state_code = 'WY';
                break;
        }

        return $state_code;
    }


    function parse_csv( $csv_file, $filter = false ){
        $data_labels = [];
        $data_raw = [];
        $data_series_groups = [];
        $axis_label_values = [];

        $data = [];
        $line_index = 0;

        foreach ( $csv_file as $line ){
            if ( $line_index === 0 ){
                $data_labels = str_getcsv($line);
                $axis_label_data = $data_labels[0];

                $axis_label_title = array_shift( $data_labels );
                $axis_label_values = $data_labels;
            } else {
                $data[] = str_getcsv($line);
            }
            $line_index++;
        }

        $data_raw = $data;

        $data_labels = array_map( function( $data_point ){
            return $data_point[0];
        }, $data );

        $data_series_groups = array_map( function( $data_point ){
            array_shift( $data_point );
            return $data_point;
        }, $data );

        $grouped_data_labels = array();
        $grouped_data_values = array();


        foreach ( $data_series_groups as $index => $datapoints ) {
            if ( in_array( $data_labels[$index], $grouped_data_labels ) ){
                $i = 0;

                foreach ( $grouped_data_values[array_search( $data_labels[$index], $grouped_data_labels )] as $i => $value ) {
                    $grouped_data_values[array_search( $data_labels[$index], $grouped_data_labels )][$i] += floatval( $data_series_groups[$index][$i] );
                }
            } else {
                $grouped_data_labels[] = $data_labels[$index];
                $grouped_data_values[] = array_map( function( $datapoint ){
                    return floatval( $datapoint );
                }, $data_series_groups[$index] );
            }
        }        

        $dataset = [];

        foreach ( $grouped_data_labels as $index => $label ) {
            $datapoint = array();
            $datapoint[$label] = $grouped_data_values[$index];
            $dataset[] = $datapoint;
        }

        usort( $dataset, function( $a, $b ) {
            return intval( $b[array_keys( $b )[0]][0] ) - intval( $a[array_keys( $a )[0]][0] );
        } );

        $chart_labels_sorted = [];
        $chart_data_sorted = [];

        foreach ($dataset as $datapoint ) {
            $chart_labels_sorted[] = array_keys( $datapoint )[0];
            $chart_data_sorted[] = array_values( $datapoint )[0];
        }

        $parsed_data = array(
            'data_raw' => $data_raw,
            'data_labels_raw' => $data_labels,
            'data_series_raw' => $data_series_groups,
            'data_labels' => $grouped_data_labels,
            'data_series' => $grouped_data_values,
            'data_labels_sorted' => $chart_labels_sorted,
            'data_series_sorted' => $chart_data_sorted,
            'axis_label_title' => $axis_label_title,
            'axis_label_values' => $axis_label_values
        );

        // log_this( 'parsed_data', $parsed_data );
        return $parsed_data;
    }


    function get_data( $attributes ){
        $chart_config = isset( $attributes['chartConfigJSON'] ) ? htmlspecialchars( $attributes['chartConfigJSON'] ) : '';
        $chart_options = isset( $attributes['chartOptionsJSON'] ) ? htmlspecialchars( $attributes['chartOptionsJSON'] ) : '';
        $chart_border_text = isset( $attributes['chartBorderText'] ) ? htmlspecialchars( $attributes['chartBorderText'] ) : '';
        $source = isset( $attributes['dataSourceFileURL'] ) ? $attributes['dataSourceFileURL'] : '';
        $source_file_id = isset( $attributes['dataSourceFileID'] ) ? $attributes['dataSourceFileID'] : '';
        $color_scheme = isset( $attributes['colorScheme'] ) ? $attributes['colorScheme'] : '';
        $show_gridlines = !empty( $attributes['showGridlines'] ) ? $attributes['showGridlines'] : 'true';
        $data_label = isset( $attributes['label'] ) ? $attributes['label'] : '';
        $data_sort = isset( $attributes['sortData'] ) ? $attributes['sortData'] : '';
        $data_filter = isset( $attributes['columnsAsFilters'] ) ? $attributes['columnsAsFilters'] : '';
        $data_limit = isset( $attributes['dataLimit'] ) ? $attributes['dataLimit'] : '';
        $data_prefix = isset( $attributes['dataPrefix'] ) ? $attributes['dataPrefix'] : '';
        $data_suffix = isset( $attributes['dataSuffix'] ) ? $attributes['dataSuffix'] : '';
        $vis_type = isset( $attributes['vizType'] ) ? $attributes['vizType'] : '';
        $size = isset( $attributes['vizSize'] ) ? $attributes['vizSize'] : '';
        $use_log_scale = isset( $attributes['useLogScale'] ) ? $attributes['useLogScale'] : '';
        $ignore_null = isset( $attributes['ignoreNullValues'] ) ? $attributes['ignoreNullValues'] : '';

        $attachment = get_attached_file( $attributes['dataSourceFileID'] );
        $csv_file = file( $attachment );
        $data = self::parse_csv( $csv_file );

        $chart_labels = $data['data_labels'];
        $chart_data = $data['data_series'];

        $data['data_labels'] = $chart_labels;
        $data['data_series'] = $chart_data;
        return $data;
    }

    function get_data_ajax(){
        $attributes = $_POST[ 'attributes' ];
        $filter = $_POST[ 'columnsAsFilters' ];
        // log_this( $attributes );

        $attachment = get_attached_file( $attributes['dataSourceFileID'] );
        $csv_file = file( $attachment );
        $data = self::parse_csv( $csv_file, $filter );

        $data['source_file_id'] = $attributes['dataSourceFileID'];

        wp_send_json( $data );
    }

    function get_svg_map_html_ajax(){
        $options =  array(
            'source_file_id'=> $_POST[ 'source_file_id' ],
            'map_area' => $_POST[ 'map_area' ],
            'color_scheme' => $_POST[ 'color_scheme' ],
            'data_prefix' => $_POST[ 'data_prefix' ],
            'data_suffix' => $_POST[ 'data_suffix' ],
            'data_label' => $_POST[ 'data_label' ],
            'show_gridlines' => !empty( $_POST[ 'show_gridlines' ] ) ? $_POST[ 'show_gridlines' ] : 'true',
            'slider' => $_POST[ 'slider' ],
            'data' => $_POST[ 'data' ]
        );
        $svg_html = self::get_svg_map_html( $options );
        wp_send_json( $svg_html );
    }

    function get_dataviz_width_restrictions(){
        $width_restriction_small = get_option( 'ftf_dataviz_gutenberg_block_width_restriction_small', self::$width_restriction_small_default );
        $width_restriction_medium = get_option( 'ftf_dataviz_gutenberg_block_width_restriction_medium', self::$width_restriction_medium_default );

        if ( !( intval( $width_restriction_small ) > 0 ) ){
            $width_restriction_small = self::$width_restriction_small_default;
        }

        if ( !( intval( $width_restriction_medium ) > 0 ) ){
            $width_restriction_medium = self::$width_restriction_medium_default;
        }

        return array(
            'small' => $width_restriction_small,
            'medium' => $width_restriction_medium
        );
    }

    function render_callback( $attributes, $content ){
        $block_id = uniqid();
        $chart_config = isset( $attributes['chartConfigJSON'] ) ? htmlspecialchars( $attributes['chartConfigJSON'] ) : '';
        $chart_options = isset( $attributes['chartOptionsJSON'] ) ? htmlspecialchars( $attributes['chartOptionsJSON'] ) : '';
        $chart_border_text = isset( $attributes['chartBorderText'] ) ? htmlspecialchars( $attributes['chartBorderText'] ) : '';
        $chart_border_text_animation_length = 'dur="' . ( 20 * log10( strlen( $chart_border_text ) ) ) . 's"';
        $source_url = isset( $attributes['dataSourceFileURL'] ) ? $attributes['dataSourceFileURL'] : '';
        $source = isset( $attributes['dataSourceFileURL'] ) ? $attributes['dataSourceFileURL'] : '';
        $source_file_id = isset( $attributes['dataSourceFileID'] ) ? $attributes['dataSourceFileID'] : '';
        $color_scheme = isset( $attributes['colorScheme'] ) ? $attributes['colorScheme'] : '';
        $data_label = isset( $attributes['label'] ) ? $attributes['label'] : '';
        $data_sort = isset( $attributes['sortData'] ) ? $attributes['sortData'] : 'false';
        $data_filter = isset( $attributes['columnsAsFilters'] ) ? $attributes['columnsAsFilters'] : 'false';
        $show_gridlines = isset( $attributes['showGridlines'] ) ? $attributes['showGridlines'] : 'true';
        $data_limit = isset( $attributes['dataLimit'] ) ? $attributes['dataLimit'] : '';
        $data_prefix = isset( $attributes['dataPrefix'] ) ? $attributes['dataPrefix'] : '';
        $data_suffix = isset( $attributes['dataSuffix'] ) ? $attributes['dataSuffix'] : '';
        $viz_type = isset( $attributes['vizType'] ) ? $attributes['vizType'] : 'bar';
        $size = isset( $attributes['vizSize'] ) ? $attributes['vizSize'] : 'large';

        $slider = false;

        if ( empty( $size ) ){
            $size = 'large';
        }

        $map_style = isset( $attributes['mapStyle'] ) ? $attributes['mapStyle'] : 'tile_grid';
        $map_area = isset( $attributes['mapArea'] ) ? $attributes['mapArea'] : 'US';
        $use_log_scale = isset( $attributes['useLogScale'] ) ? $attributes['useLogScale'] : 'false';
        $column_filter = isset( $attributes['columnsAsFilters'] ) ? $attributes['columnsAsFilters'] : 'false';
        $ignore_null = isset( $attributes['ignoreNullValues'] ) ? $attributes['ignoreNullValues'] : 'false';

        $width_restrictions = self::get_dataviz_width_restrictions();

        $width_restriction_small = $width_restrictions['small'];
        $width_restriction_medium = $width_restrictions['medium'];

        $data = self::get_data( $attributes );
        $data_json = json_encode( $data );

        // log_this( array(
        //     'attributes' => $attributes,
        //     'content' => $content,
        //     'source_file_id' => $source_file_id
        //     // 'attachment' => $attachment,
        //     // 'data' => $data
        // ) );

        $style = '';

        if ( empty( $viz_type ) ){
            $viz_type = 'bar';
        }

        switch ( $viz_type ) {
            case 'bar':
            case 'line':
            case 'scatter':
            case 'scatter-dates':
                switch ( $size ) {
                    case 'small':
                        $attr_width = 500;
                        $attr_height = 400;
                        $width_height = 'width="' . $attr_width . '" height="' . $attr_height . '"';
                        $style = 'max-width: ' . $width_restriction_small . 'px;';
                        break;
                    case 'medium':
                        $attr_width = 500;
                        $attr_height = 300;
                        $width_height = 'width="' . $attr_width . '" height="' . $attr_height . '"';
                        $style = 'max-width: ' . $width_restriction_medium . 'px;';
                        break;
                    case 'large':
                        $attr_width = 500;
                        $attr_height = 250;                        
                        $width_height = 'width="' . $attr_width . '" height="' . $attr_height . '"';
                        $style = 'max-width: 100%;';
                        break;
                }
                break;
            case 'horizontalBar':
                switch ( $size ) {
                    case 'small':
                        $width_height = 'width="400" height="400"';
                        $attr_width = 400;
                        $attr_height = 400;                        
                        $style = 'max-width: ' . $width_restriction_small . 'px;';
                        break;
                    case 'medium':
                        $width_height = 'width="400" height="300"';
                        $attr_width = 400;
                        $attr_height = 300;                        
                        $style = 'max-width: ' . $width_restriction_medium . 'px;';
                        break;
                    case 'large':
                        $width_height = 'width="400" height="200"';
                        $attr_width = 400;
                        $attr_height = 200;                        
                        break;
                }
                break;
            case 'pie':
            case 'doughnut':
            case 'polarArea':
            case 'radar':
                $width_height = 'width="200" height="200"';
                $attr_width = 200;
                $attr_height = 200;
                switch ( $size ) {
                    case 'small':
                        $style = 'max-width: ' . $width_restriction_small . 'px;';
                        break;
                    case 'medium':
                        $style = 'max-width: ' . $width_restriction_medium . 'px;';
                        break;
                }
                break;
            case 'map':
                $width_height = '';

                $slider = true;

                switch ( $size ) {
                    case 'small':
                        $style = 'max-width: ' . $width_restriction_small . 'px;';
                        break;
                    case 'medium':
                        $style = 'max-width: ' . $width_restriction_medium . 'px;';
                        break;
                }
                break;
        }

        $table_css = '';

        if ( $size === 'small' ){
            $table_css = ' style="max-width:' . $width_restriction_small . 'px; margin: 0 auto;" ';
        } elseif ( $size === 'medium' ){
            $table_css = ' style="max-width:' . $width_restriction_medium . 'px; margin: 0 auto;" ';
        }

        if ( $data_sort === 'true' ){
            $data_labels = $data['data_labels_sorted'];
            $data_series = $data['data_series_sorted'];
        } else {
            $data_labels = $data['data_labels'];
            $data_series = $data['data_series'];
        }

        if ( $ignore_null === 'true' ){

            foreach ( $data_series as $index_outer => $datapoints ) {
                $remove_datapoint = true;

                foreach ( $datapoints as $index_inner => $datapoint ) {

                    if ( !empty( $data_series[$index_outer][$index_inner] ) && intval( $data_series[$index_outer][$index_inner] ) !== 0 ){
                        $remove_datapoint = false;
                        break;
                        
                    }
                }

                if ( $remove_datapoint ){
                    unset ( $data_series[$index_outer] );
                    unset ( $data_labels[$index_outer] );
                }
            }
        }

        if ( $data_limit ){
            $data_series = array_slice( $data_series, 0, intval( $data_limit ) );
            $data_series = array_slice( $data_series, 0, intval( $data_limit ) );
        }
        
        $class_names = isset( $attributes['className'] ) ? $attributes['className'] : '';
        $table_html = <<<HTML
            <table class="ftf-dataviz ftf-dataviz-table sr-only {$class_names}" border="0" cellpadding="5" width="100%" {$table_css} summary="This is the text alternative for the data visualization.">
                <caption>{$data_label}</caption>
                <tbody>
HTML;

        $table_html .= '<tr>';

        $table_html .= '<th scope="col">' . $data['axis_label_title'] .'</th>';

        foreach ( $data['axis_label_values'] as $index => $label ) {
            $table_html .= '<th scope="col" style="text-align:right">' . $label . '</th>';
        }

        $table_html .= '</tr>';

        foreach ( $data_series as $outer_index => $datapoints ) {
            $table_html .= '<tr>';

            $table_html .= '<th scope="row">' . $data_labels[$outer_index] . '</th>';

            foreach ( $datapoints as $index => $datapoint ) {
                $table_html .= '<td style="text-align:right">' . $data_prefix . number_format( $datapoint ) . $data_suffix . '</td>';
            }

            $table_html .= '</tr>';
        }

        $table_html .= '</tbody></table>';
        $table_html_visible = str_replace( 'sr-only', '', $table_html );
        $canvas_html = '';
        $svg_html = '';

        $render_html = '';

        if ( !empty( $source_file_id ) ){
        $render_html .= <<<HTML
            <script type="text/javascript">
                window.ftfDataviz = window.ftfDataviz || {};
                window.ftfDataviz[{$source_file_id}] = {$data_json}
            </script>
HTML;

        }

        if ( !empty( $data_labels) && is_array( $data_labels ) ){
            $axis_label_data = $data_labels[0];
        } else {
            $axis_label_data = '';
        }


     
        $wrapper_styles = '';
        $text_border_html = '';

        if ( !empty( $chart_border_text ) ){
            // $style .= 'border:10px solid white;';
            $wrapper_styles = 'padding: 10px 40px;';
            $text_border_html = <<<HTML
                <svg width="100%" height="100%" viewBox="0 0 {$attr_width} {$attr_height}" style="position: absolute; left: 0; right: 0;top: 0;bottom: 0; overflow: visible; pointer-events: none; z-index: 10;">
                    <path id="border-text-path-{$block_id}" fill="transparent" d="M 0 0  H {$attr_width} V {$attr_height} H 0 L 0 0" style="pointer-events: none;"></path>
                    
                    <text width="100%" style="transform:translate3d(0,0,0);" style="pointer-events: none;">
                        <textPath id="text-path-{$block_id}" style="transform:translate3d(0,0,0); font-family: monospace; font-size: 0.75rem; fill: silver;" alignment-baseline="top" xlink:href="#border-text-path-{$block_id}">{$chart_border_text}
                            <animate
                               xlink:href    = "#text-path-{$block_id}"
                               attributeName = "startOffset"
                               from          = "-100%"
                               to            = "100%"
                               start         = "0s"
                               {$chart_border_text_animation_length}
                               repeatCount   = "indefinite"
                               fill          = "freeze"
                               style         = "pointer-events: none;"
                            />
                        </textPath>
                    </text>
                </svg>
HTML;               
        }

        $class_names = isset( $attributes['className'] ) ? $attributes['className'] : '';

        $canvas_html .= <<<HTML
        <div class="ftf-dataviz-chart-wrapper" style="position: relative; {$wrapper_styles}">
            {$text_border_html}
            <canvas
                tabIndex="0"
                class="ftf-dataviz ftf-dataviz-chart chart {$class_names}"
                {$width_height}
                style="{$style} margin: 1.5rem auto; position: relative; left: 0; right: 0;top: 0;bottom: 0;"
                role="img"
                aria-label="{$data_label}"
                data-config="{$chart_config}"
                data-options="{$chart_options}"
                data-size="{$size}"
                data-source-id="{$source_file_id}"
                data-label="{$data_label}"
                data-log-scale="{$use_log_scale}"
                data-column-filter="{$column_filter}"
                data-ignore-null="{$ignore_null}"
                data-sort="{$data_sort}"
                data-limit="{$data_limit}"
                data-prefix="{$data_prefix}"
                data-suffix="{$data_suffix}"
                data-axis-label-data="{$axis_label_data}"
                data-color-scheme="{$color_scheme}"
                data-show-gridlines="{$show_gridlines}"
                data-type="{$viz_type}"
            ></canvas>
            {$table_html}
            <noscript>{$table_html_visible}</noscript>
        </div>
HTML;

        if ( $viz_type === 'map' ){
            $svg_html = self::get_svg_map_html( array(
                'source_file_id' => $source_file_id,
                'map_style' => $map_style,
                'map_area' => $map_area,
                'color_scheme' => $color_scheme,
                'show_gridlines' => $show_gridlines,
                'data_prefix' => $data_prefix,
                'data_suffix' => $data_suffix,
                'data_label' => $data_label,
                'data' => $data,
                'slider' => $slider,
                'style' => $style
            ) );
        }

        if ( $viz_type === 'table' ){
            $render_html .= $table_html_visible;
        }
        elseif ( $viz_type === 'map' ){
            $render_html .= <<<HTML
            {$svg_html}
            {$table_html}
            <noscript>{$table_html_visible}</noscript>
HTML;
        } else {
            $render_html .= $canvas_html;
        }


        return $render_html;
    }

    function get_svg_map_html( $options ){
        $svg_html = '';
        $svg_legend = '';
        $svg_legend_colors = '';

        $data_us_states = array();
        $data_us_states_colors = array();

        $data = $options['data'];

        $source_file_id = isset( $options['source_file_id'] ) ? $options['source_file_id'] : '';
        $style = isset( $options['style'] ) ? $options['style'] : '';
        $data_prefix = isset( $options['data_prefix'] ) ? $options['data_prefix'] : '';
        $data_suffix = isset( $options['data_suffix'] ) ? $options['data_suffix'] : '';
        $data_label = isset( $options['data_label'] ) ? $options['data_label'] : '';

        $show_gridlines = 'false';

        if ( !empty( $options['show_gridlines'] ) ){
            $show_gridlines = $options['show_gridlines'];
        }

        $colors = array_reverse( end( self::get_color_palettes()[$options['color_scheme']] ) );

        if ( !empty( $options['map_area'] ) ){
            $map_area = $options['map_area'];
        } else {
            $map_area = 'US';
        }

        array_shift( $colors );
        array_shift( $colors );

        $value_group_count = count( $colors );

        foreach ($data['data_labels_raw'] as $i => $state ) {
            $state = self::get_us_state_code( $state );
            $value = $data['data_series_raw'][$i][0];
            $data_us_states[$state] = $value;
        }

        $min_value = min( array_diff( array_values( $data_us_states ), array( null ) ) );
        $max_value = max( array_diff( array_values( $data_us_states ), array( null ) ) );

        $value_group_step = ( $max_value - $min_value ) / $value_group_count;

        $value_groups = array_map( function( $el, $index ) use ( $min_value, $value_group_step ) {
            return $min_value + ( $index * $value_group_step );
        }, $colors, array_keys( $colors ) );

        foreach ( array_keys( $data_us_states ) as $state ){
            $index = count( $value_groups );
            while( $index ) {
                $val_compare = $value_groups[--$index];

                if ( $data_us_states[$state] >= $val_compare ){
                    $data_us_states_colors[$state] = $colors[ $index ];
                    break;
                }
            }
        }

        $svg_legend .= <<<HTML
        <div class="ftf-dataviz-map-legend">
           <div class="ftf-dataviz-map-legend-min-max">
               <span class="ftf-dataviz-map-legend-min">{$data_prefix}{$min_value}{$data_suffix}</span>
               <span class="ftf-dataviz-map-legend-max">{$data_prefix}{$max_value}{$data_suffix}</span>
           </div>
           <div class="ftf-dataviz-map-legend-colors"></div>
           <p>{$data_label}</p>
        </div>
HTML;

    $svg_gridlines = '';

    if ( $show_gridlines === 'true' ){
        $svg_gridlines = <<<HTML
            <g class="gridlines" transform="translate(0,0)">
                <g class="row">
                    <rect class="cell" x="1" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="53" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="105" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="157" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="209" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="261" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="313" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="365" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="417" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="469" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="521" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="573" y="1" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                </g>
                <g class="row">
                    <rect class="cell" x="1" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="53" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="105" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="157" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="209" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="261" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="313" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="365" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="417" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="469" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="521" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="573" y="53" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                </g>
                <g class="row">
                    <rect class="cell" x="1" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="53" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="105" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="157" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="209" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="261" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="313" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="365" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="417" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="469" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="521" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="573" y="105" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                </g>
                <g class="row">
                    <rect class="cell" x="1" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="53" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="105" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="157" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="209" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="261" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="313" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="365" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="417" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="469" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="521" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="573" y="157" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                </g>
                <g class="row">
                    <rect class="cell" x="1" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="53" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="105" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="157" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="209" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="261" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="313" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="365" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="417" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="469" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="521" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="573" y="209" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                </g>
                <g class="row">
                    <rect class="cell" x="1" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="53" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="105" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="157" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="209" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="261" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="313" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="365" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="417" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="469" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="521" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="573" y="261" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                </g>
                <g class="row">
                    <rect class="cell" x="1" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="53" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="105" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="157" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="209" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="261" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="313" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="365" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="417" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="469" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="521" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="573" y="313" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                </g>
                <g class="row">
                    <rect class="cell" x="1" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="53" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="105" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="157" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="209" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="261" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="313" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="365" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="417" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="469" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="521" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                    <rect class="cell" x="573" y="365" width="52" height="52" style="fill: white; stroke: lightgrey;"></rect>
                </g>
            </g>
HTML;    
        }
        
        foreach ( $colors as $index => $color ) {
            $svg_legend_colors .= $color . ' ' . ( ( $index + 1 )/$value_group_count * 100) . '%' . ( ( $index + 1 ) === $value_group_count ? '' : ',');
        }

        $dataviz_slider = '';

        if ( true || $slider === true ){
            $year_start = 1968;
            $year_end = 2017;

            $map_data = array_map( function( $datapoints ){
                $datapoints[0] = self::get_us_state_code( $datapoints[0] );
                return $datapoints;
            }, $data['data_raw'] );

            $map_data_encoded = htmlspecialchars( json_encode( $map_data ), ENT_QUOTES, 'UTF-8' );

            $dataviz_slider .= <<<HTML
            <div class="ftf-dataviz-slider-container">
                <div class="ftf-dataviz-slider-title">{$year_start}</div>
                <input type="range"
                       min="{$year_start}"
                       max="{$year_end}"
                       value="{$year_start}"
                       class="ftf-dataviz-slider"
                       data-data="{$map_data_encoded}"
                       data-prefix="{$data_prefix}"
                       data-suffix="{$data_suffix}"
                       data-source-file-id="{$source_file_id}"
                >
            </div>
HTML;
        }


        switch ( $map_area ) {
            case 'US':
                $svg_html .= <<<HTML
                <style type="text/css">
                    .ftf-dataviz-map {
                        font-family: Arial, sans-serif;
                        font-size: 0.8rem;
                        color: #696969;
                    }
                    .ftf-dataviz-map .state {
                        fill: #c0c0c0;
                        stroke: #fff;
                        opacity: 0.4; 
                    }
                    .ftf-dataviz-map-legend{
                        width: 100%;
                        padding: 1px;
                        clear: both;
                    }
                    .ftf-dataviz-map-legend p{
                        line-height: 1.2rem;
                    }
                    .ftf-dataviz-map-legend-min{
                    }
                    .ftf-dataviz-map-legend-max{
                        float: right;
                    }
                    .ftf-dataviz-map-legend-min-max{
                        width: 200px;
                    }
                    .ftf-dataviz-map-legend-colors{
                        width: 200px;
                        height: 1.2rem;
                        margin-bottom: 10px;
                        opacity: 0.4;    
                        background: linear-gradient( 90deg, {$svg_legend_colors} );
                    }
                    .ftf-dataviz-slider-container{
                        text-align: center;
                        padding: 2rem 0;
                    }
                    .ftf-dataviz-slider{
                        width: 100%;
                        max-width: 640px;
                    }
                </style>
                <div class="ftf-dataviz ftf-dataviz-map" style="{$style} margin: 1.5rem auto;">
                    {$svg_legend}
                    <svg viewBox="0 0 625 440">
                        {$svg_gridlines}
                        <g class="gridmap">
                            <g>
                                <rect class="state WA" x="53" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['WA']}"></rect>
                                <text class="label WA" x="78" y="130" text-anchor="middle">WA</text>
                                <text class="label WA" x="78" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['WA']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state OR" x="53" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['OR']}"></rect>
                                <text class="label OR" x="78" y="182" text-anchor="middle">OR</text>
                                <text class="label OR" x="78" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['OR']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state CA" x="53" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['CA']}"></rect>
                                <text class="label CA" x="78" y="234" text-anchor="middle">CA</text>
                                <text class="label CA" x="78" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['CA']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state HI" x="1" y="365" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['HI']}"></rect>
                                <text class="label HI" x="26" y="390" text-anchor="middle">HI</text>
                                <text class="label HI" x="26" y="390" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['HI']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state ID" x="105" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['ID']}"></rect>
                                <text class="label ID" x="130" y="130" text-anchor="middle">ID</text>
                                <text class="label ID" x="130" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['ID']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state NV" x="105" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['NV']}"></rect>
                                <text class="label NV" x="130" y="182" text-anchor="middle">NV</text>
                                <text class="label NV" x="130" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['NV']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state UT" x="105" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['UT']}"></rect>
                                <text class="label UT" x="130" y="234" text-anchor="middle">UT</text>
                                <text class="label UT" x="130" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['UT']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state AZ" x="105" y="261" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['AZ']}"></rect>
                                <text class="label AZ" x="130" y="286" text-anchor="middle">AZ</text>
                                <text class="label AZ" x="130" y="286" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['AZ']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state AK" x="1" y="1" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['AK']};"></rect>
                                <text class="label AK" x="26" y="26" text-anchor="middle">AK</text>
                                <text class="label AK" x="26" y="26" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['AK']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state MT" x="157" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['MT']}"></rect>
                                <text class="label MT" x="182" y="130" text-anchor="middle">MT</text>
                                <text class="label MT" x="182" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['MT']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state WY" x="157" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['WY']}"></rect>
                                <text class="label WY" x="182" y="182" text-anchor="middle">WY</text>
                                <text class="label WY" x="182" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['WY']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state CO" x="157" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['CO']}"></rect>
                                <text class="label CO" x="182" y="234" text-anchor="middle">CO</text>
                                <text class="label CO" x="182" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['CO']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state NM" x="157" y="261" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['NM']}"></rect>
                                <text class="label NM" x="182" y="286" text-anchor="middle">NM</text>
                                <text class="label NM" x="182" y="286" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['NM']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state ND" x="209" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['ND']}"></rect>
                                <text class="label ND" x="234" y="130" text-anchor="middle">ND</text>
                                <text class="label ND" x="234" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['ND']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state SD" x="209" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['SD']}"></rect>
                                <text class="label SD" x="234" y="182" text-anchor="middle">SD</text>
                                <text class="label SD" x="234" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['SD']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state NE" x="209" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['NE']}"></rect>
                                <text class="label NE" x="234" y="234" text-anchor="middle">NE</text>
                                <text class="label NE" x="234" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['NE']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state KS" x="209" y="261" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['KS']}"></rect>
                                <text class="label KS" x="234" y="286" text-anchor="middle">KS</text>
                                <text class="label KS" x="234" y="286" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['KS']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state OK" x="209" y="313" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['OK']}"></rect>
                                <text class="label OK" x="234" y="338" text-anchor="middle">OK</text>
                                <text class="label OK" x="234" y="338" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['OK']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state TX" x="209" y="365" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['TX']}"></rect>
                                <text class="label TX" x="234" y="390" text-anchor="middle">TX</text>
                                <text class="label TX" x="234" y="390" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['TX']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state MN" x="261" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['MN']}"></rect>
                                <text class="label MN" x="286" y="130" text-anchor="middle">MN</text>
                                <text class="label MN" x="286" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['MN']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state IA" x="261" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['IA']}"></rect>
                                <text class="label IA" x="286" y="182" text-anchor="middle">IA</text>
                                <text class="label IA" x="286" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['IA']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state MO" x="261" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['MO']}"></rect>
                                <text class="label MO" x="286" y="234" text-anchor="middle">MO</text>
                                <text class="label MO" x="286" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['MO']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state AR" x="261" y="261" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['AR']}"></rect>
                                <text class="label AR" x="286" y="286" text-anchor="middle">AR</text>
                                <text class="label AR" x="286" y="286" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['AR']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state LA" x="261" y="313" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['LA']}"></rect>
                                <text class="label LA" x="286" y="337" text-anchor="middle">LA</text>
                                <text class="label LA" x="286" y="337" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['LA']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state WI" x="365" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['WI']}"></rect>
                                <text class="label WI" x="390" y="130" text-anchor="middle">WI</text>
                                <text class="label WI" x="390" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['WI']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state IL" x="313" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['IL']}"></rect>
                                <text class="label IL" x="338" y="130" text-anchor="middle">IL</text>
                                <text class="label IL" x="338" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['IL']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state IN" x="313" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['IN']}"></rect>
                                <text class="label IN" x="338" y="182" text-anchor="middle">IN</text>
                                <text class="label IN" x="338" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['IN']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state KY" x="313" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['KY']}"></rect>
                                <text class="label KY" x="338" y="234" text-anchor="middle">KY</text>
                                <text class="label KY" x="338" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['KY']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state TN" x="313" y="261" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['TN']}"></rect>
                                <text class="label TN" x="338" y="286" text-anchor="middle">TN</text>
                                <text class="label TN" x="338" y="286" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['TN']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state MS" x="313" y="313" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['MS']}"></rect>
                                <text class="label MS" x="338" y="338" text-anchor="middle">MS</text>
                                <text class="label MS" x="338" y="338" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['MS']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state MI" x="417" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['MI']}"></rect>
                                <text class="label MI" x="442" y="130" text-anchor="middle">MI</text>
                                <text class="label MI" x="442" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['MI']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state OH" x="365" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['OH']}"></rect>
                                <text class="label OH" x="390" y="182" text-anchor="middle">OH</text>
                                <text class="label OH" x="390" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['OH']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state WV" x="365" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['WV']}"></rect>
                                <text class="label WV" x="390" y="234" text-anchor="middle">WV</text>
                                <text class="label WV" x="390" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['WV']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state NC" x="365" y="261" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['NC']}"></rect>
                                <text class="label NC" x="390" y="286" text-anchor="middle">NC</text>
                                <text class="label NC" x="390" y="286" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['NC']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state AL" x="365" y="313" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['AL']}"></rect>
                                <text class="label AL" x="390" y="338" text-anchor="middle">AL</text>
                                <text class="label AL" x="390" y="338" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['AL']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state DC" x="469" y="261" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['DC']}"></rect>
                                <text class="lfill:{$data_us_states_colors['DC']}abel DC" x="494" y="286" text-anchor="middle">DC</text>
                                <text class="label DC" x="494" y="286" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['DC']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state FL" x="469" y="365" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['FL']}"></rect>
                                <text class="label FL" x="494" y="390" text-anchor="middle">FL</text>
                                <text class="label FL" x="494" y="390" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['FL']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state PA" x="417" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['PA']}"></rect>
                                <text class="label PA" x="442" y="182" text-anchor="middle">PA</text>
                                <text class="label PA" x="442" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['PA']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state VA" x="417" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['VA']}"></rect>
                                <text class="label VA" x="442" y="234" text-anchor="middle">VA</text>
                                <text class="label VA" x="442" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['VA']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state SC" x="417" y="261" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['SC']}"></rect>
                                <text class="label SC" x="442" y="286" text-anchor="middle">SC</text>
                                <text class="label SC" x="442" y="286" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['SC']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state GA" x="417" y="313" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['GA']}"></rect>
                                <text class="label GA" x="442" y="338" text-anchor="middle">GA</text>
                                <text class="label GA" x="442" y="338" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['GA']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state NY" x="469" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['NY']}"></rect>
                                <text class="label NY" x="494" y="130" text-anchor="middle">NY</text>
                                <text class="label NY" x="494" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['NY']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state NJ" x="469" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['NJ']}"></rect>
                                <text class="label NJ" x="494" y="182" text-anchor="middle">NJ</text>
                                <text class="label NJ" x="494" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['NJ']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state MD" x="469" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['MD']}"></rect>
                                <text class="label MD" x="494" y="234" text-anchor="middle">MD</text>
                                <text class="label MD" x="494" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['MD']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state VT" x="521" y="53" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['VT']}"></rect>
                                <text class="label VT" x="546" y="78" text-anchor="middle">VT</text>
                                <text class="label VT" x="546" y="78" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['VT']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state MA" x="573" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['MA']}"></rect>
                                <text class="label MA" x="598" y="130" text-anchor="middle">MA</text>
                                <text class="label MA" x="598" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['MA']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state CT" x="521" y="157" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['CT']}"></rect>
                                <text class="label CT" x="546" y="182" text-anchor="middle">CT</text>
                                <text class="label CT" x="546" y="182" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['CT']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state DE" x="521" y="209" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['DE']}"></rect>
                                <text class="label DE" x="546" y="234" text-anchor="middle">DE</text>
                                <text class="label DE" x="546" y="234" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['DE']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state ME" x="573" y="1" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['ME']}"></rect>
                                <text class="label ME" x="598" y="26" text-anchor="middle">ME</text>
                                <text class="label ME" x="598" y="26" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['ME']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state NH" x="573" y="53" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['NH']}"></rect>
                                <text class="label NH" x="598" y="78" text-anchor="middle">NH</text>
                                <text class="label NH" x="598" y="78" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['NH']}{$data_suffix}</text>
                            </g>
                            <g>
                                <rect class="state RI" x="521" y="105" width="52" height="52" style="opacity: 0.4; fill:{$data_us_states_colors['RI']}"></rect>
                                <text class="label RI" x="546" y="130" text-anchor="middle">RI</text>
                                <text class="label RI" x="546" y="130" text-anchor="middle" dy="1em">{$data_prefix}{$data_us_states['RI']}{$data_suffix}</text>
                            </g>
                        </g>
                    </svg>
                    {$dataviz_slider}
                </div>
HTML;


                break;
        }

        $svg_html = str_replace( array(
            '">' . $data_prefix . '</text',
            '">' . $data_suffix . '</text',
            '">' . $data_prefix .  $data_suffix . '</text'
        ), '"></text', $svg_html );

        return $svg_html;
    }

    function enqueue_scripts_and_styles(){
        if ( has_block( 'ftf/dataviz-gutenberg-block' ) ) {
            $scripts = array(
                array(
                    'name' => 'chartjs',
                    'path' => 'libs/chart.js/chart.min.js',
                    'dependencies' => array( 'momentjs' )
                ),
                array(
                    'name' => 'momentjs',
                    'path' => 'libs/moment.js/moment.min.js',
                    'dependencies' => array()
                ),
                // array(
                //     'name' => 'ftf-dataviz-frontend',
                //     'path' => 'dist/js/scripts.min.js',
                //     'dependencies' => array( 'chartjs' )
                // )            
            );

            $rendering_engine = get_option( 'ftf_dataviz_gutenberg_block_rendering_engine', 'chart.js' );
            $engine_script_name = 'ftf-dataviz-' . $rendering_engine;
            $width_restrictions = self::get_dataviz_width_restrictions();

            switch ( $rendering_engine ) {
                case 'chart.js':
                    $engine_script_name = 'ftf-dataviz-chart.js';

                    array_push( $scripts, array(
                        'name' => $engine_script_name,
                        'path' => 'dist/js/chartjs.min.js',
                        'dependencies' => array( 'chartjs' )
                    ) );
                    break;
            }

            $styles = array(
                array(
                    'name' => 'ftf-dataviz',
                    'path' => 'dist/css/styles.min.css',
                    'dependencies' => array()
                ),
                array(
                    'name' => 'chartjs',
                    'path' => 'libs/chart.js/chart.min.css',
                    'dependencies' => array()
                )
            );

            foreach ( $scripts as $script ) {
                $js_file_path = plugin_dir_path( __FILE__ ) . $script['path'];
                wp_register_script( $script['name'], plugin_dir_url( __FILE__ ) . $script['path'], $script['dependencies'], filemtime( $js_file_path ));
                wp_enqueue_script( $script['name'] );
            }

            foreach ( $styles as $style ) {
                $css_file_path = plugin_dir_path( __FILE__ ) . $style['path'];
                wp_register_style( $style['name'], plugin_dir_url( __FILE__ ) . $style['path'], $style['dependencies'], filemtime( $css_file_path ), 'all' );
                wp_enqueue_style( $style['name'] );
            }

           wp_add_inline_script( $engine_script_name, self::get_color_palettes( 'html' ) );
            $css_sr_only = ".sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;}";

            wp_add_inline_style( 'ftf-dataviz', $css_sr_only );

        }
    }

    function enqueue_scripts_and_styles_admin(){
        $scripts = array(
            array(
                'name' => 'chartjs',
                'path' => 'libs/chart.js/chart.min.js',
                'dependencies' => array()
            ),
            array(
                'name' => $engine_script_name,
                'path' => 'dist/js/chartjs.min.js',
                'dependencies' => array( 'chartjs' )
            )
        );

        foreach ( $scripts as $script ) {
            $js_file_path = plugin_dir_path( __FILE__ ) . $script['path'];
            wp_register_script( $script['name'], plugin_dir_url( __FILE__ ) . $script['path'], $script['dependencies'], filemtime( $js_file_path ));
            wp_enqueue_script( $script['name'] );
        }
    }

    function add_inline_scripts(){
        echo '<script type="text/javascript" >' . self::get_color_palettes( 'html' ) . '</script>';
    }

    function settings_init(){
        register_setting( 'ftf_dataviz_gutenberg_block', 'ftf_dataviz_gutenberg_block_rendering_engine', 'esc_attr' );
        register_setting( 'ftf_dataviz_gutenberg_block', 'ftf_dataviz_gutenberg_block_width_restriction_small', 'esc_attr' );
        register_setting( 'ftf_dataviz_gutenberg_block', 'ftf_dataviz_gutenberg_block_width_restriction_medium', 'esc_attr' );
        register_setting( 'ftf_dataviz_gutenberg_block', 'ftf_dataviz_gutenberg_block_width_restriction_large', 'esc_attr' );

        add_settings_section(
            'ftf_dataviz_gutenberg_block_settings', 
            __( '', 'wordpress' ), 
            array( $this, 'render_settings_form' ),
            'ftf_dataviz_gutenberg_block'
        );
    }

    function render_settings_page(){ ?>
        <div class="wrap">
        <h1>Data Visualization Gutenberg Block</h1>

        <form action='options.php' method='post' >
            <?php
            settings_fields( 'ftf_dataviz_gutenberg_block' );
            do_settings_sections( 'ftf_dataviz_gutenberg_block' );
            submit_button();
            ?>
            </form>
        </div>
    <?php }

    function render_settings_form(){
        $rendering_engine = get_option( 'ftf_dataviz_gutenberg_block_rendering_engine' );
        $width_restrictions = self::get_dataviz_width_restrictions();
        $width_restriction_small = $width_restrictions['small'];
        $width_restriction_medium = $width_restrictions['medium'];

        ?>

        <div class="notice notice-info">
            <p>This plugin is under active development and is only available via direct download <a href="#">from its GitHub repo</a>.</p>
            <p>Please reach out with any questions <a href="mailto:stefan@fourtonfish.com?subject=Data Visualization Gutenberg Block">via email</a> or <a href="https://twitter.com/fourtonfish">Twitter</a>.</p>
        </div>

        <h3 id="about">About the plugin</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec egestas urna nec dui luctus dignissim. Sed luctus fermentum egestas. Donec lobortis vestibulum lorem sed imperdiet. Pellentesque tempus leo vel dapibus commodo. Sed pharetra molestie purus sed aliquam. Phasellus feugiat lacus vitae purus viverra, vel aliquam elit tincidunt. Aliquam eleifend fermentum risus, id vulputate nunc ultricies sed. Nulla est neque, mollis et sapien non, maximus laoreet turpis. Etiam aliquet consectetur felis non pellentesque. Quisque commodo blandit dui, eu eleifend nisl pharetra ut.</p>
        
        <h3 id="settings">Settings</h3>

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="ftf-dataviz-gutenberg-block-rendering-engine">Rendering engine</label>
                    </th>
                    <td>
                        <select id="ftf-dataviz-gutenberg-block-rendering-engine" name="ftf_dataviz_gutenberg_block_rendering_engine">
                            <option value="chart.js" <?php selected( $rendering_engine, 'chart.js' ); ?>>chart.js</option>
                            <option disabled value="d3.js" <?php selected( $rendering_engine, 'd3.js' ); ?>>D3.js</option>
                        </select>
                        <p class="description">
                            Currently limited to <a href="https://www.chartjs.org/" target="_blank">chart.js</a>, more options are being considered.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ftf-dataviz-gutenberg-block-width-restriction">Width restriction</label>
                    </th>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ftf-dataviz-gutenberg-block-width-restriction-small">Small</label>
                    </th>
                    <td>
                        <input type="number" id="ftf-dataviz-gutenberg-block-width-restriction-small"
                        name="ftf_dataviz_gutenberg_block_width_restriction_small"
                        value="<?php echo $width_restriction_small; ?>"
                        placeholder="<?php echo self::$width_restriction_small_default; ?>"> px
                        <p class="description">
                            Limit width of charts when using "small" size.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ftf-dataviz-gutenberg-block-width-restriction-medium">Medium</label>
                    </th>
                    <td>
                        <input type="number" id="ftf-dataviz-gutenberg-block-width-restriction-medium"
                        name="ftf_dataviz_gutenberg_block_width_restriction_medium"
                        value="<?php echo $width_restriction_small; ?>"
                        placeholder="<?php echo self::$width_restriction_medium_default; ?>"> px
                        <p class="description">
                            Limit width of charts when using "medium" size.
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3 id="lorem">To-do</h3>
        <ul class="ul-disc">
            <li><strike>dynamic previews for Gutenberg blocks</strike></li>
            <li>new visualization types:
                <ul class="ul-disc">
                    <li>maps</li>
                    <li>bubble charts</li>
                    <li>scatter charts</li>
                </ul>
            </li>
            <li>publish the plugin to the WordPress plugin directory</li>
            <li>improve keyboard navigation for data files with multiple datasets (<a href="https://github.com/chartjs/Chart.js/issues/1976" target="_blank">pending open issue on chart.js project repo</a>)</li>
            <li>consider adding multiple rendering engines (<a href="https://d3js.org/" target="_blank">D3.js</a>, and more)</li>
        </ul>
    <?php }

    function add_settings_page(){
        add_options_page(
            'Settings for the Data Visualization Gutenberg block plugin',
            'Data Visualization',
            'manage_options',
            'ftf-dataviz-gutenberg-block',
            array( $this, 'render_settings_page' )
        );
    }

    function settings_page_link( $links ){
        $url = esc_url( add_query_arg(
            'page',
            'ftf-dataviz-gutenberg-block',
            get_admin_url() . 'admin.php'
        ) );
        $settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
        array_push(
            $links,
            $settings_link
        );
        return $links;
    }

}

$ftf_dataviz_gutenberg_block_init = new FTF_Dataviz_Gutenberg_Block();
