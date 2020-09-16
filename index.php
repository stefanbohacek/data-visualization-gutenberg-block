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

    public static $color_palettes = <<<SCRIPT
        var ftfHelpers = ftfHelpers || {};
        // This product includes color specifications and designs developed by Cynthia Brewer (http://colorbrewer.org/).
        // JavaScript specs as packaged in the D3 library (d3js.org). Please see license at http://colorbrewer.org/export/LICENSE.txt
        ftfHelpers.colorPalettes = {
            'Green to yellow': {
                3: ["#f7fcb9","#addd8e","#31a354"].reverse(),
                4: ["#ffffcc","#c2e699","#78c679","#238443"].reverse(),
                5: ["#ffffcc","#c2e699","#78c679","#31a354","#006837"].reverse(),
                6: ["#ffffcc","#d9f0a3","#addd8e","#78c679","#31a354","#006837"].reverse(),
                7: ["#ffffcc","#d9f0a3","#addd8e","#78c679","#41ab5d","#238443","#005a32"].reverse(),
                8: ["#ffffe5","#f7fcb9","#d9f0a3","#addd8e","#78c679","#41ab5d","#238443","#005a32"].reverse(),
                9: ["#ffffe5","#f7fcb9","#d9f0a3","#addd8e","#78c679","#41ab5d","#238443","#006837","#004529"].reverse()
            },
            'Blue-green-yellow': {
                3: ["#edf8b1","#7fcdbb","#2c7fb8"].reverse(),
                4: ["#ffffcc","#a1dab4","#41b6c4","#225ea8"].reverse(),
                5: ["#ffffcc","#a1dab4","#41b6c4","#2c7fb8","#253494"].reverse(),
                6: ["#ffffcc","#c7e9b4","#7fcdbb","#41b6c4","#2c7fb8","#253494"].reverse(),
                7: ["#ffffcc","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#0c2c84"].reverse(),
                8: ["#ffffd9","#edf8b1","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#0c2c84"].reverse(),
                9: ["#ffffd9","#edf8b1","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#253494","#081d58"].reverse()
            },
            'Blue to green': {
                3: ["#e0f3db","#a8ddb5","#43a2ca"].reverse(),
                4: ["#f0f9e8","#bae4bc","#7bccc4","#2b8cbe"].reverse(),
                5: ["#f0f9e8","#bae4bc","#7bccc4","#43a2ca","#0868ac"].reverse(),
                6: ["#f0f9e8","#ccebc5","#a8ddb5","#7bccc4","#43a2ca","#0868ac"].reverse(),
                7: ["#f0f9e8","#ccebc5","#a8ddb5","#7bccc4","#4eb3d3","#2b8cbe","#08589e"].reverse(),
                8: ["#f7fcf0","#e0f3db","#ccebc5","#a8ddb5","#7bccc4","#4eb3d3","#2b8cbe","#08589e"].reverse(),
                9: ["#f7fcf0","#e0f3db","#ccebc5","#a8ddb5","#7bccc4","#4eb3d3","#2b8cbe","#0868ac","#084081"].reverse()
            },
            'Green to blue': {
                3: ["#e5f5f9","#99d8c9","#2ca25f"].reverse(),
                4: ["#edf8fb","#b2e2e2","#66c2a4","#238b45"].reverse(),
                5: ["#edf8fb","#b2e2e2","#66c2a4","#2ca25f","#006d2c"].reverse(),
                6: ["#edf8fb","#ccece6","#99d8c9","#66c2a4","#2ca25f","#006d2c"].reverse(),
                7: ["#edf8fb","#ccece6","#99d8c9","#66c2a4","#41ae76","#238b45","#005824"].reverse(),
                8: ["#f7fcfd","#e5f5f9","#ccece6","#99d8c9","#66c2a4","#41ae76","#238b45","#005824"].reverse(),
                9: ["#f7fcfd","#e5f5f9","#ccece6","#99d8c9","#66c2a4","#41ae76","#238b45","#006d2c","#00441b"].reverse()
            },
            'Green-blue-purple': {
                3: ["#ece2f0","#a6bddb","#1c9099"].reverse(),
                4: ["#f6eff7","#bdc9e1","#67a9cf","#02818a"].reverse(),
                5: ["#f6eff7","#bdc9e1","#67a9cf","#1c9099","#016c59"].reverse(),
                6: ["#f6eff7","#d0d1e6","#a6bddb","#67a9cf","#1c9099","#016c59"].reverse(),
                7: ["#f6eff7","#d0d1e6","#a6bddb","#67a9cf","#3690c0","#02818a","#016450"].reverse(),
                8: ["#fff7fb","#ece2f0","#d0d1e6","#a6bddb","#67a9cf","#3690c0","#02818a","#016450"].reverse(),
                9: ["#fff7fb","#ece2f0","#d0d1e6","#a6bddb","#67a9cf","#3690c0","#02818a","#016c59","#014636"].reverse()
            },
            'Blue to purple': {
                3: ["#ece7f2","#a6bddb","#2b8cbe"].reverse(),
                4: ["#f1eef6","#bdc9e1","#74a9cf","#0570b0"].reverse(),
                5: ["#f1eef6","#bdc9e1","#74a9cf","#2b8cbe","#045a8d"].reverse(),
                6: ["#f1eef6","#d0d1e6","#a6bddb","#74a9cf","#2b8cbe","#045a8d"].reverse(),
                7: ["#f1eef6","#d0d1e6","#a6bddb","#74a9cf","#3690c0","#0570b0","#034e7b"].reverse(),
                8: ["#fff7fb","#ece7f2","#d0d1e6","#a6bddb","#74a9cf","#3690c0","#0570b0","#034e7b"].reverse(),
                9: ["#fff7fb","#ece7f2","#d0d1e6","#a6bddb","#74a9cf","#3690c0","#0570b0","#045a8d","#023858"].reverse()
            },
            'Purple to blue': {
                3: ["#e0ecf4","#9ebcda","#8856a7"].reverse(),
                4: ["#edf8fb","#b3cde3","#8c96c6","#88419d"].reverse(),
                5: ["#edf8fb","#b3cde3","#8c96c6","#8856a7","#810f7c"].reverse(),
                6: ["#edf8fb","#bfd3e6","#9ebcda","#8c96c6","#8856a7","#810f7c"].reverse(),
                7: ["#edf8fb","#bfd3e6","#9ebcda","#8c96c6","#8c6bb1","#88419d","#6e016b"].reverse(),
                8: ["#f7fcfd","#e0ecf4","#bfd3e6","#9ebcda","#8c96c6","#8c6bb1","#88419d","#6e016b"].reverse(),
                9: ["#f7fcfd","#e0ecf4","#bfd3e6","#9ebcda","#8c96c6","#8c6bb1","#88419d","#810f7c","#4d004b"].reverse()
            },
            'Purple to red': {
                3: ["#fde0dd","#fa9fb5","#c51b8a"].reverse(),
                4: ["#feebe2","#fbb4b9","#f768a1","#ae017e"].reverse(),
                5: ["#feebe2","#fbb4b9","#f768a1","#c51b8a","#7a0177"].reverse(),
                6: ["#feebe2","#fcc5c0","#fa9fb5","#f768a1","#c51b8a","#7a0177"].reverse(),
                7: ["#feebe2","#fcc5c0","#fa9fb5","#f768a1","#dd3497","#ae017e","#7a0177"].reverse(),
                8: ["#fff7f3","#fde0dd","#fcc5c0","#fa9fb5","#f768a1","#dd3497","#ae017e","#7a0177"].reverse(),
                9: ["#fff7f3","#fde0dd","#fcc5c0","#fa9fb5","#f768a1","#dd3497","#ae017e","#7a0177","#49006a"].reverse()
            },
            'Red to purple': {
                3: ["#e7e1ef","#c994c7","#dd1c77"].reverse(),
                4: ["#f1eef6","#d7b5d8","#df65b0","#ce1256"].reverse(),
                5: ["#f1eef6","#d7b5d8","#df65b0","#dd1c77","#980043"].reverse(),
                6: ["#f1eef6","#d4b9da","#c994c7","#df65b0","#dd1c77","#980043"].reverse(),
                7: ["#f1eef6","#d4b9da","#c994c7","#df65b0","#e7298a","#ce1256","#91003f"].reverse(),
                8: ["#f7f4f9","#e7e1ef","#d4b9da","#c994c7","#df65b0","#e7298a","#ce1256","#91003f"].reverse(),
                9: ["#f7f4f9","#e7e1ef","#d4b9da","#c994c7","#df65b0","#e7298a","#ce1256","#980043","#67001f"].reverse()
            },
            'Red to orange': {
                3: ["#fee8c8","#fdbb84","#e34a33"].reverse(),
                4: ["#fef0d9","#fdcc8a","#fc8d59","#d7301f"].reverse(),
                5: ["#fef0d9","#fdcc8a","#fc8d59","#e34a33","#b30000"].reverse(),
                6: ["#fef0d9","#fdd49e","#fdbb84","#fc8d59","#e34a33","#b30000"].reverse(),
                7: ["#fef0d9","#fdd49e","#fdbb84","#fc8d59","#ef6548","#d7301f","#990000"].reverse(),
                8: ["#fff7ec","#fee8c8","#fdd49e","#fdbb84","#fc8d59","#ef6548","#d7301f","#990000"].reverse(),
                9: ["#fff7ec","#fee8c8","#fdd49e","#fdbb84","#fc8d59","#ef6548","#d7301f","#b30000","#7f0000"].reverse()
            },
            'Red-orange-yellow': {
                3: ["#ffeda0","#feb24c","#f03b20"].reverse(),
                4: ["#ffffb2","#fecc5c","#fd8d3c","#e31a1c"].reverse(),
                5: ["#ffffb2","#fecc5c","#fd8d3c","#f03b20","#bd0026"].reverse(),
                6: ["#ffffb2","#fed976","#feb24c","#fd8d3c","#f03b20","#bd0026"].reverse(),
                7: ["#ffffb2","#fed976","#feb24c","#fd8d3c","#fc4e2a","#e31a1c","#b10026"].reverse(),
                8: ["#ffffcc","#ffeda0","#fed976","#feb24c","#fd8d3c","#fc4e2a","#e31a1c","#b10026"].reverse(),
                9: ["#ffffcc","#ffeda0","#fed976","#feb24c","#fd8d3c","#fc4e2a","#e31a1c","#bd0026","#800026"].reverse()
            },
            'Brown-orange-yellow': {
                3: ["#fff7bc","#fec44f","#d95f0e"].reverse(),
                4: ["#ffffd4","#fed98e","#fe9929","#cc4c02"].reverse(),
                5: ["#ffffd4","#fed98e","#fe9929","#d95f0e","#993404"].reverse(),
                6: ["#ffffd4","#fee391","#fec44f","#fe9929","#d95f0e","#993404"].reverse(),
                7: ["#ffffd4","#fee391","#fec44f","#fe9929","#ec7014","#cc4c02","#8c2d04"].reverse(),
                8: ["#ffffe5","#fff7bc","#fee391","#fec44f","#fe9929","#ec7014","#cc4c02","#8c2d04"].reverse(),
                9: ["#ffffe5","#fff7bc","#fee391","#fec44f","#fe9929","#ec7014","#cc4c02","#993404","#662506"].reverse()
            },
            Purples: {
                3: ["#efedf5","#bcbddc","#756bb1"].reverse(),
                4: ["#f2f0f7","#cbc9e2","#9e9ac8","#6a51a3"].reverse(),
                5: ["#f2f0f7","#cbc9e2","#9e9ac8","#756bb1","#54278f"].reverse(),
                6: ["#f2f0f7","#dadaeb","#bcbddc","#9e9ac8","#756bb1","#54278f"].reverse(),
                7: ["#f2f0f7","#dadaeb","#bcbddc","#9e9ac8","#807dba","#6a51a3","#4a1486"].reverse(),
                8: ["#fcfbfd","#efedf5","#dadaeb","#bcbddc","#9e9ac8","#807dba","#6a51a3","#4a1486"].reverse(),
                9: ["#fcfbfd","#efedf5","#dadaeb","#bcbddc","#9e9ac8","#807dba","#6a51a3","#54278f","#3f007d"].reverse()
            },
            Blues: {
                3: ["#deebf7","#9ecae1","#3182bd"].reverse(),
                4: ["#eff3ff","#bdd7e7","#6baed6","#2171b5"].reverse(),
                5: ["#eff3ff","#bdd7e7","#6baed6","#3182bd","#08519c"].reverse(),
                6: ["#eff3ff","#c6dbef","#9ecae1","#6baed6","#3182bd","#08519c"].reverse(),
                7: ["#eff3ff","#c6dbef","#9ecae1","#6baed6","#4292c6","#2171b5","#084594"].reverse(),
                8: ["#f7fbff","#deebf7","#c6dbef","#9ecae1","#6baed6","#4292c6","#2171b5","#084594"].reverse(),
                9: ["#f7fbff","#deebf7","#c6dbef","#9ecae1","#6baed6","#4292c6","#2171b5","#08519c","#08306b"].reverse()
            },
            Greens: {
                3: ["#e5f5e0","#a1d99b","#31a354"].reverse(),
                4: ["#edf8e9","#bae4b3","#74c476","#238b45"].reverse(),
                5: ["#edf8e9","#bae4b3","#74c476","#31a354","#006d2c"].reverse(),
                6: ["#edf8e9","#c7e9c0","#a1d99b","#74c476","#31a354","#006d2c"].reverse(),
                7: ["#edf8e9","#c7e9c0","#a1d99b","#74c476","#41ab5d","#238b45","#005a32"].reverse(),
                8: ["#f7fcf5","#e5f5e0","#c7e9c0","#a1d99b","#74c476","#41ab5d","#238b45","#005a32"].reverse(),
                9: ["#f7fcf5","#e5f5e0","#c7e9c0","#a1d99b","#74c476","#41ab5d","#238b45","#006d2c","#00441b"].reverse()
            },
            Oranges: {
                3: ["#fee6ce","#fdae6b","#e6550d"].reverse(),
                4: ["#feedde","#fdbe85","#fd8d3c","#d94701"].reverse(),
                5: ["#feedde","#fdbe85","#fd8d3c","#e6550d","#a63603"].reverse(),
                6: ["#feedde","#fdd0a2","#fdae6b","#fd8d3c","#e6550d","#a63603"].reverse(),
                7: ["#feedde","#fdd0a2","#fdae6b","#fd8d3c","#f16913","#d94801","#8c2d04"].reverse(),
                8: ["#fff5eb","#fee6ce","#fdd0a2","#fdae6b","#fd8d3c","#f16913","#d94801","#8c2d04"].reverse(),
                9: ["#fff5eb","#fee6ce","#fdd0a2","#fdae6b","#fd8d3c","#f16913","#d94801","#a63603","#7f2704"].reverse()
            },
            Reds: {
                3: ["#fee0d2","#fc9272","#de2d26"].reverse(),
                4: ["#fee5d9","#fcae91","#fb6a4a","#cb181d"].reverse(),
                5: ["#fee5d9","#fcae91","#fb6a4a","#de2d26","#a50f15"].reverse(),
                6: ["#fee5d9","#fcbba1","#fc9272","#fb6a4a","#de2d26","#a50f15"].reverse(),
                7: ["#fee5d9","#fcbba1","#fc9272","#fb6a4a","#ef3b2c","#cb181d","#99000d"].reverse(),
                8: ["#fff5f0","#fee0d2","#fcbba1","#fc9272","#fb6a4a","#ef3b2c","#cb181d","#99000d"].reverse(),
                9: ["#fff5f0","#fee0d2","#fcbba1","#fc9272","#fb6a4a","#ef3b2c","#cb181d","#a50f15","#67000d"].reverse()
            },
            Grays: {
                3: ["#f0f0f0","#bdbdbd","#636363"].reverse(),
                4: ["#f7f7f7","#cccccc","#969696","#525252"].reverse(),
                5: ["#f7f7f7","#cccccc","#969696","#636363","#252525"].reverse(),
                6: ["#f7f7f7","#d9d9d9","#bdbdbd","#969696","#636363","#252525"].reverse(),
                7: ["#f7f7f7","#d9d9d9","#bdbdbd","#969696","#737373","#525252","#252525"].reverse(),
                8: ["#ffffff","#f0f0f0","#d9d9d9","#bdbdbd","#969696","#737373","#525252","#252525"].reverse(),
                9: ["#ffffff","#f0f0f0","#d9d9d9","#bdbdbd","#969696","#737373","#525252","#252525","#000000"].reverse()
            },
            'Purple to orange': {
                3: ["#f1a340","#f7f7f7","#998ec3"].reverse(),
                4: ["#e66101","#fdb863","#b2abd2","#5e3c99"].reverse(),
                5: ["#e66101","#fdb863","#f7f7f7","#b2abd2","#5e3c99"].reverse(),
                6: ["#b35806","#f1a340","#fee0b6","#d8daeb","#998ec3","#542788"].reverse(),
                7: ["#b35806","#f1a340","#fee0b6","#f7f7f7","#d8daeb","#998ec3","#542788"].reverse(),
                8: ["#b35806","#e08214","#fdb863","#fee0b6","#d8daeb","#b2abd2","#8073ac","#542788"].reverse(),
                9: ["#b35806","#e08214","#fdb863","#fee0b6","#f7f7f7","#d8daeb","#b2abd2","#8073ac","#542788"].reverse(),
                10: ["#7f3b08","#b35806","#e08214","#fdb863","#fee0b6","#d8daeb","#b2abd2","#8073ac","#542788","#2d004b"].reverse(),
                11: ["#7f3b08","#b35806","#e08214","#fdb863","#fee0b6","#f7f7f7","#d8daeb","#b2abd2","#8073ac","#542788","#2d004b"].reverse()
            },
            'Green to brown': {
                3: ["#d8b365","#f5f5f5","#5ab4ac"].reverse(),
                4: ["#a6611a","#dfc27d","#80cdc1","#018571"].reverse(),
                5: ["#a6611a","#dfc27d","#f5f5f5","#80cdc1","#018571"].reverse(),
                6: ["#8c510a","#d8b365","#f6e8c3","#c7eae5","#5ab4ac","#01665e"].reverse(),
                7: ["#8c510a","#d8b365","#f6e8c3","#f5f5f5","#c7eae5","#5ab4ac","#01665e"].reverse(),
                8: ["#8c510a","#bf812d","#dfc27d","#f6e8c3","#c7eae5","#80cdc1","#35978f","#01665e"].reverse(),
                9: ["#8c510a","#bf812d","#dfc27d","#f6e8c3","#f5f5f5","#c7eae5","#80cdc1","#35978f","#01665e"].reverse(),
                10: ["#543005","#8c510a","#bf812d","#dfc27d","#f6e8c3","#c7eae5","#80cdc1","#35978f","#01665e","#003c30"].reverse(),
                11: ["#543005","#8c510a","#bf812d","#dfc27d","#f6e8c3","#f5f5f5","#c7eae5","#80cdc1","#35978f","#01665e","#003c30"].reverse()
            },
            'Purple to green': {
                3: ["#af8dc3","#f7f7f7","#7fbf7b"].reverse(),
                4: ["#7b3294","#c2a5cf","#a6dba0","#008837"].reverse(),
                5: ["#7b3294","#c2a5cf","#f7f7f7","#a6dba0","#008837"].reverse(),
                6: ["#762a83","#af8dc3","#e7d4e8","#d9f0d3","#7fbf7b","#1b7837"].reverse(),
                7: ["#762a83","#af8dc3","#e7d4e8","#f7f7f7","#d9f0d3","#7fbf7b","#1b7837"].reverse(),
                8: ["#762a83","#9970ab","#c2a5cf","#e7d4e8","#d9f0d3","#a6dba0","#5aae61","#1b7837"].reverse(),
                9: ["#762a83","#9970ab","#c2a5cf","#e7d4e8","#f7f7f7","#d9f0d3","#a6dba0","#5aae61","#1b7837"].reverse(),
                10: ["#40004b","#762a83","#9970ab","#c2a5cf","#e7d4e8","#d9f0d3","#a6dba0","#5aae61","#1b7837","#00441b"].reverse(),
                11: ["#40004b","#762a83","#9970ab","#c2a5cf","#e7d4e8","#f7f7f7","#d9f0d3","#a6dba0","#5aae61","#1b7837","#00441b"].reverse()
            },
            'Purple to light green': {
                3: ["#e9a3c9","#f7f7f7","#a1d76a"].reverse(),
                4: ["#d01c8b","#f1b6da","#b8e186","#4dac26"].reverse(),
                5: ["#d01c8b","#f1b6da","#f7f7f7","#b8e186","#4dac26"].reverse(),
                6: ["#c51b7d","#e9a3c9","#fde0ef","#e6f5d0","#a1d76a","#4d9221"].reverse(),
                7: ["#c51b7d","#e9a3c9","#fde0ef","#f7f7f7","#e6f5d0","#a1d76a","#4d9221"].reverse(),
                8: ["#c51b7d","#de77ae","#f1b6da","#fde0ef","#e6f5d0","#b8e186","#7fbc41","#4d9221"].reverse(),
                9: ["#c51b7d","#de77ae","#f1b6da","#fde0ef","#f7f7f7","#e6f5d0","#b8e186","#7fbc41","#4d9221"].reverse(),
                10: ["#8e0152","#c51b7d","#de77ae","#f1b6da","#fde0ef","#e6f5d0","#b8e186","#7fbc41","#4d9221","#276419"].reverse(),
                11: ["#8e0152","#c51b7d","#de77ae","#f1b6da","#fde0ef","#f7f7f7","#e6f5d0","#b8e186","#7fbc41","#4d9221","#276419"].reverse()
            },
            'Blue to red': {
                3: ["#ef8a62","#f7f7f7","#67a9cf"].reverse(),
                4: ["#ca0020","#f4a582","#92c5de","#0571b0"].reverse(),
                5: ["#ca0020","#f4a582","#f7f7f7","#92c5de","#0571b0"].reverse(),
                6: ["#b2182b","#ef8a62","#fddbc7","#d1e5f0","#67a9cf","#2166ac"].reverse(),
                7: ["#b2182b","#ef8a62","#fddbc7","#f7f7f7","#d1e5f0","#67a9cf","#2166ac"].reverse(),
                8: ["#b2182b","#d6604d","#f4a582","#fddbc7","#d1e5f0","#92c5de","#4393c3","#2166ac"].reverse(),
                9: ["#b2182b","#d6604d","#f4a582","#fddbc7","#f7f7f7","#d1e5f0","#92c5de","#4393c3","#2166ac"].reverse(),
                10: ["#67001f","#b2182b","#d6604d","#f4a582","#fddbc7","#d1e5f0","#92c5de","#4393c3","#2166ac","#053061"].reverse(),
                11: ["#67001f","#b2182b","#d6604d","#f4a582","#fddbc7","#f7f7f7","#d1e5f0","#92c5de","#4393c3","#2166ac","#053061"].reverse()
            },
            'Gray to red': {
                3: ["#ef8a62","#ffffff","#999999"].reverse(),
                4: ["#ca0020","#f4a582","#bababa","#404040"].reverse(),
                5: ["#ca0020","#f4a582","#ffffff","#bababa","#404040"].reverse(),
                6: ["#b2182b","#ef8a62","#fddbc7","#e0e0e0","#999999","#4d4d4d"].reverse(),
                7: ["#b2182b","#ef8a62","#fddbc7","#ffffff","#e0e0e0","#999999","#4d4d4d"].reverse(),
                8: ["#b2182b","#d6604d","#f4a582","#fddbc7","#e0e0e0","#bababa","#878787","#4d4d4d"].reverse(),
                9: ["#b2182b","#d6604d","#f4a582","#fddbc7","#ffffff","#e0e0e0","#bababa","#878787","#4d4d4d"].reverse(),
                10: ["#67001f","#b2182b","#d6604d","#f4a582","#fddbc7","#e0e0e0","#bababa","#878787","#4d4d4d","#1a1a1a"].reverse(),
                11: ["#67001f","#b2182b","#d6604d","#f4a582","#fddbc7","#ffffff","#e0e0e0","#bababa","#878787","#4d4d4d","#1a1a1a"].reverse()
            },
            'Blue-yellow-red': {
                3: ["#fc8d59","#ffffbf","#91bfdb"].reverse(),
                4: ["#d7191c","#fdae61","#abd9e9","#2c7bb6"].reverse(),
                5: ["#d7191c","#fdae61","#ffffbf","#abd9e9","#2c7bb6"].reverse(),
                6: ["#d73027","#fc8d59","#fee090","#e0f3f8","#91bfdb","#4575b4"].reverse(),
                7: ["#d73027","#fc8d59","#fee090","#ffffbf","#e0f3f8","#91bfdb","#4575b4"].reverse(),
                8: ["#d73027","#f46d43","#fdae61","#fee090","#e0f3f8","#abd9e9","#74add1","#4575b4"].reverse(),
                9: ["#d73027","#f46d43","#fdae61","#fee090","#ffffbf","#e0f3f8","#abd9e9","#74add1","#4575b4"].reverse(),
                10: ["#a50026","#d73027","#f46d43","#fdae61","#fee090","#e0f3f8","#abd9e9","#74add1","#4575b4","#313695"].reverse(),
                11: ["#a50026","#d73027","#f46d43","#fdae61","#fee090","#ffffbf","#e0f3f8","#abd9e9","#74add1","#4575b4","#313695"].reverse()
            },
            Spectral: {
                3: ["#fc8d59","#ffffbf","#99d594"].reverse(),
                4: ["#d7191c","#fdae61","#abdda4","#2b83ba"].reverse(),
                5: ["#d7191c","#fdae61","#ffffbf","#abdda4","#2b83ba"].reverse(),
                6: ["#d53e4f","#fc8d59","#fee08b","#e6f598","#99d594","#3288bd"].reverse(),
                7: ["#d53e4f","#fc8d59","#fee08b","#ffffbf","#e6f598","#99d594","#3288bd"].reverse(),
                8: ["#d53e4f","#f46d43","#fdae61","#fee08b","#e6f598","#abdda4","#66c2a5","#3288bd"].reverse(),
                9: ["#d53e4f","#f46d43","#fdae61","#fee08b","#ffffbf","#e6f598","#abdda4","#66c2a5","#3288bd"].reverse(),
                10: ["#9e0142","#d53e4f","#f46d43","#fdae61","#fee08b","#e6f598","#abdda4","#66c2a5","#3288bd","#5e4fa2"].reverse(),
                11: ["#9e0142","#d53e4f","#f46d43","#fdae61","#fee08b","#ffffbf","#e6f598","#abdda4","#66c2a5","#3288bd","#5e4fa2"].reverse()
            },
            'Green-yellow-red': {
                3: ["#fc8d59","#ffffbf","#91cf60"].reverse(),
                4: ["#d7191c","#fdae61","#a6d96a","#1a9641"].reverse(),
                5: ["#d7191c","#fdae61","#ffffbf","#a6d96a","#1a9641"].reverse(),
                6: ["#d73027","#fc8d59","#fee08b","#d9ef8b","#91cf60","#1a9850"].reverse(),
                7: ["#d73027","#fc8d59","#fee08b","#ffffbf","#d9ef8b","#91cf60","#1a9850"].reverse(),
                8: ["#d73027","#f46d43","#fdae61","#fee08b","#d9ef8b","#a6d96a","#66bd63","#1a9850"].reverse(),
                9: ["#d73027","#f46d43","#fdae61","#fee08b","#ffffbf","#d9ef8b","#a6d96a","#66bd63","#1a9850"].reverse(),
                10: ["#a50026","#d73027","#f46d43","#fdae61","#fee08b","#d9ef8b","#a6d96a","#66bd63","#1a9850","#006837"].reverse(),
                11: ["#a50026","#d73027","#f46d43","#fdae61","#fee08b","#ffffbf","#d9ef8b","#a6d96a","#66bd63","#1a9850","#006837"].reverse()
            },
            Accent: {
                3: ["#7fc97f","#beaed4","#fdc086"].reverse(),
                4: ["#7fc97f","#beaed4","#fdc086","#ffff99"].reverse(),
                5: ["#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0"].reverse(),
                6: ["#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0","#f0027f"].reverse(),
                7: ["#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0","#f0027f","#bf5b17"].reverse(),
                8: ["#7fc97f","#beaed4","#fdc086","#ffff99","#386cb0","#f0027f","#bf5b17","#666666"].reverse()
            },
            Dark: {
                3: ["#1b9e77","#d95f02","#7570b3"].reverse(),
                4: ["#1b9e77","#d95f02","#7570b3","#e7298a"].reverse(),
                5: ["#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e"].reverse(),
                6: ["#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e","#e6ab02"].reverse(),
                7: ["#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e","#e6ab02","#a6761d"].reverse(),
                8: ["#1b9e77","#d95f02","#7570b3","#e7298a","#66a61e","#e6ab02","#a6761d","#666666"].reverse()
            },
            Paired: {
                3: ["#a6cee3","#1f78b4","#b2df8a"].reverse(),
                4: ["#a6cee3","#1f78b4","#b2df8a","#33a02c"].reverse(),
                5: ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99"].reverse(),
                6: ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c"].reverse(),
                7: ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f"].reverse(),
                8: ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00"].reverse(),
                9: ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00","#cab2d6"].reverse(),
                10: ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00","#cab2d6","#6a3d9a"].reverse(),
                11: ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00","#cab2d6","#6a3d9a","#ffff99"].reverse(),
                12: ["#a6cee3","#1f78b4","#b2df8a","#33a02c","#fb9a99","#e31a1c","#fdbf6f","#ff7f00","#cab2d6","#6a3d9a","#ffff99","#b15928"].reverse()
            },
            'Pastel 1': {
                3: ["#fbb4ae","#b3cde3","#ccebc5"].reverse(),
                4: ["#fbb4ae","#b3cde3","#ccebc5","#decbe4"].reverse(),
                5: ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6"].reverse(),
                6: ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6","#ffffcc"].reverse(),
                7: ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6","#ffffcc","#e5d8bd"].reverse(),
                8: ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6","#ffffcc","#e5d8bd","#fddaec"].reverse(),
                9: ["#fbb4ae","#b3cde3","#ccebc5","#decbe4","#fed9a6","#ffffcc","#e5d8bd","#fddaec","#f2f2f2"].reverse()
            },
            'Pastel 2': {
                3: ["#b3e2cd","#fdcdac","#cbd5e8"].reverse(),
                4: ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4"].reverse(),
                5: ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4","#e6f5c9"].reverse(),
                6: ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4","#e6f5c9","#fff2ae"].reverse(),
                7: ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4","#e6f5c9","#fff2ae","#f1e2cc"].reverse(),
                8: ["#b3e2cd","#fdcdac","#cbd5e8","#f4cae4","#e6f5c9","#fff2ae","#f1e2cc","#cccccc"].reverse()
            },
            'Set 1': {
                3: ["#e41a1c","#377eb8","#4daf4a"].reverse(),
                4: ["#e41a1c","#377eb8","#4daf4a","#984ea3"].reverse(),
                5: ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00"].reverse(),
                6: ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00","#ffff33"].reverse(),
                7: ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00","#ffff33","#a65628"].reverse(),
                8: ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00","#ffff33","#a65628","#f781bf"].reverse(),
                9: ["#e41a1c","#377eb8","#4daf4a","#984ea3","#ff7f00","#ffff33","#a65628","#f781bf","#999999"].reverse()
            },
            'Set 2': {
                3: ["#66c2a5","#fc8d62","#8da0cb"].reverse(),
                4: ["#66c2a5","#fc8d62","#8da0cb","#e78ac3"].reverse(),
                5: ["#66c2a5","#fc8d62","#8da0cb","#e78ac3","#a6d854"].reverse(),
                6: ["#66c2a5","#fc8d62","#8da0cb","#e78ac3","#a6d854","#ffd92f"].reverse(),
                7: ["#66c2a5","#fc8d62","#8da0cb","#e78ac3","#a6d854","#ffd92f","#e5c494"].reverse(),
                8: ["#66c2a5","#fc8d62","#8da0cb","#e78ac3","#a6d854","#ffd92f","#e5c494","#b3b3b3"].reverse()
            },
            'Set 3': {
                3: ["#8dd3c7","#ffffb3","#bebada"].reverse(),
                4: ["#8dd3c7","#ffffb3","#bebada","#fb8072"].reverse(),
                5: ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3"].reverse(),
                6: ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462"].reverse(),
                7: ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69"].reverse(),
                8: ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5"].reverse(),
                9: ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5","#d9d9d9"].reverse(),
                10: ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5","#d9d9d9","#bc80bd"].reverse(),
                11: ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5","#d9d9d9","#bc80bd","#ccebc5"].reverse(),
                12: ["#8dd3c7","#ffffb3","#bebada","#fb8072","#80b1d3","#fdb462","#b3de69","#fccde5","#d9d9d9","#bc80bd","#ccebc5","#ffed6f"].reverse()
        } };
SCRIPT;

    function __construct(){
        add_action( 'init', array( $this, 'register_block' ) );
        add_action( 'init', array( $this, 'enqueue_scripts_and_styles' ) );
        add_action( 'wp_footer', array( $this, 'add_inline_scripts' ) );        
        // add_action( 'admin_init', array( $this, 'enqueue_scripts_and_styles_admin' ) );
        add_action( 'admin_init', array( $this, 'settings_init' ) );
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_filter( 'plugin_action_links_dataviz-gutenberg-block/index.php', array( $this, 'settings_page_link' ) );
        add_action( 'wp_ajax_get_data', array( $this, 'get_data_ajax' ), 1000 );
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

        wp_add_inline_script( 'ftf-dataviz', self::$color_palettes );
    }


    function parse_csv( $csv_file, $filter = false ){
        $data_labels = [];
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
        $source = $attributes['dataSourceFileURL'];
        $source_file_id = $attributes['dataSourceFileID'];
        $color_scheme = $attributes['colorScheme'];
        $data_label = $attributes['label'];
        $data_sort = $attributes['sortData'];
        $data_filter = $attributes['columnsAsFilters'];
        $data_limit = $attributes['dataLimit'];
        $data_prefix = $attributes['dataPrefix'];
        $data_suffix = $attributes['dataSuffix'];
        $type = $attributes['vizType'];
        $size = $attributes['vizSize'];
        $use_log_scale = $attributes['useLogScale'];
        $ignore_null = $attributes['ignoreNullValues'];

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
        $source_url = $attributes['dataSourceFileURL'];

        $source = $attributes['dataSourceFileURL'];
        $source_file_id = $attributes['dataSourceFileID'];
        $color_scheme = $attributes['colorScheme'];
        $data_label = $attributes['label'];
        $data_sort = $attributes['sortData'] ? 'true' : 'false' ;
        $data_filter = $attributes['columnsAsFilters'] ? 'true' : 'false' ;
        $data_limit = $attributes['dataLimit'];
        $data_prefix = $attributes['dataPrefix'];
        $data_suffix = $attributes['dataSuffix'];
        $type = $attributes['vizType'];
        $size = $attributes['vizSize'];

        if ( empty( $size ) ){
            $size = 'large';
        }

        $use_log_scale = $attributes['useLogScale'];
        $column_filter = $attributes['columnsAsFilters'] ? 'true' : 'false' ;
        $ignore_null = $attributes['ignoreNullValues'] ? 'true' : 'false' ;

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

        if ( empty( $type ) ){
            $type = 'bar';
        }

        switch ( $type ) {
            case 'bar':
            case 'line':
                switch ( $size ) {
                    case 'small':
                        $width_height = 'width="500" height="400"';
                        $style = 'max-width: ' . $width_restriction_small . 'px;';
                        break;
                    case 'medium':
                        $width_height = 'width="500" height="300"';
                        $style = 'max-width: ' . $width_restriction_medium . 'px;';
                        break;
                    case 'large':
                        $width_height = 'width="500" height="200"';
                        $style = 'max-width: 100%;';
                        break;
                }
                break;
            case 'horizontalBar':
                switch ( $size ) {
                    case 'small':
                        $width_height = 'width="400" height="400"';
                        $style = 'max-width: ' . $width_restriction_small . 'px;';
                        break;
                    case 'medium':
                        $width_height = 'width="400" height="300"';
                        $style = 'max-width: ' . $width_restriction_medium . 'px;';
                        break;
                    case 'large':
                        $width_height = 'width="400" height="200"';
                        break;
                }
                break;
            case 'pie':
            case 'doughnut':
            case 'polarArea':
            case 'radar':
                $width_height = 'width="200" height="200"';

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
        

        $table_html = <<<HTML
            <table class="ftf-dataviz-table sr-only {$attributes['className']}" border="0" cellpadding="5" width="100%" {$table_css} summary="This is the text alternative for the data visualization.">
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

        $canvas_html = <<<HTML
            <script type="text/javascript">
                window.ftfDataviz = window.ftfDataviz || {};
                window.ftfDataviz[{$source_file_id}] = {$data_json}
            </script>
            <canvas
                tabIndex="0"
                class="ftf-dataviz-chart chart {$attributes['className']}"
                {$width_height}
                style="{$style} margin: 1.5rem auto;"
                role="img"
                aria-label="{$data_label}"
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
                data-type="{$type}"
            ></canvas>
            {$table_html}
            <noscript>{$table_html_visible}</noscript>
HTML;

        if ( $type === 'table' ){
            $render_html = $table_html_visible;
        } else {
            $render_html = $canvas_html;
        }

        return $render_html;
    }

    function enqueue_scripts_and_styles(){
        $scripts = array(
            array(
                'name' => 'chartjs',
                'path' => 'libs/chart.js/chart.min.js',
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

       // wp_add_inline_script( $engine_script_name, self::$color_palettes );
        $css_sr_only = ".sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;}";

        wp_add_inline_style( 'ftf-dataviz', $css_sr_only );

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
        echo '<script type="text/javascript" >' . self::$color_palettes . '</script>';
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
