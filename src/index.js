import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { MediaUpload, MediaUploadCheck, RichText, InspectorControls } from '@wordpress/block-editor';
import { BaseControl, Button, PanelBody, CheckboxControl, TextControl, TextareaControl, SelectControl, ColorPalette, Placeholder } from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';


const { Component } = wp.element;
const data = wp.data.select( 'core/block-editor' );

window.ftfHelpers = window.ftfHelpers || {};

window.ftfHelpers.renderChartAdmin = function( clientId, canvasEl ){
    canvasEl.id = 'ftf-dataviz-chart-' + clientId;

    Chart.helpers.each( Chart.instances, function( instance ){
        if ( 'ftf-dataviz-chart-' + clientId === instance.chart.canvas.id ){
            instance.destroy();
        }
    } );

    window.ftfHelpers.renderChart( canvasEl );
}

window.ftfHelpers.renderTable = function( tableEl, props ){
    let tableHTML = `<tbody>
        <tr>
        <th scope="col" style="text-align:left">${ window.ftfDataviz[parseInt( props.attributes.dataSourceFileID )]['axis_label_title'] }
    </th>`;

    window.ftfDataviz[parseInt( props.attributes.dataSourceFileID )]['axis_label_values'].map( ( label, i ) => {     
        tableHTML += `<th scope="col" style="text-align:right">${label}</th>`;
    } )

    tableHTML += '</tr>';

    if ( !props.attributes.sortData ){
        window.ftfDataviz[parseInt( props.attributes.dataSourceFileID )]['data_series'].forEach( function ( datapoint, index ) {
            let keepDatapoint = true;

            if ( props.attributes.ignoreNullValues ){
                keepDatapoint = false;
                if ( datapoint && parseFloat( datapoint ) !== 0 ){
                    keepDatapoint = true;
                }
            }

            if ( keepDatapoint ){
                tableHTML += `<tr>
                    <th scope="row" style="text-align:right">
                        ${ window.ftfDataviz[parseInt( props.attributes.dataSourceFileID )]['data_labels'][index] }
                    </th>`;

                window.ftfDataviz[parseInt( props.attributes.dataSourceFileID )]['data_series'][index].forEach( function (item) {
                    tableHTML += `<td style="text-align:right">${ props.attributes.dataPrefix }${ parseInt( item ).toLocaleString() }${props.attributes.dataSuffix}</td>`;
                } );

                tableHTML += '</tr>';
            }
        } );
    }

    props.attributes.sortData && window.ftfDataviz[parseInt( props.attributes.dataSourceFileID )]['data_series_sorted'].forEach( function ( datapoint, index ) {
        let keepDatapoint = true;

        if ( props.attributes.ignoreNullValues ){
            keepDatapoint = false;

            if ( datapoint && parseFloat( datapoint ) !== 0 ){
                keepDatapoint = true;
            }
        }

        if ( keepDatapoint && ( !props.attributes.dataLimit || props.attributes.dataLimit && index < props.attributes.dataLimit ) ){
            tableHTML += `<tr>
                <th scope="row" style="text-align:left">
                    ${ window.ftfDataviz[parseInt( props.attributes.dataSourceFileID )]['data_labels_sorted'][index] }
                </th>`;

            window.ftfDataviz[parseInt( props.attributes.dataSourceFileID )]['data_series_sorted'][index].forEach( function (item) {
                    tableHTML += `<td style="text-align:right">${ props.attributes.dataPrefix}${ parseInt( item ).toLocaleString()}${ props.attributes.dataSuffix}</td>`;
                } ); 
            tableHTML += '</tr>';
        }
    } )

    tableEl.innerHTML = tableHTML + '</tbody>';
}

window.ftfHelpers.renderSVG = function( svgEl, props ){
    let svgHTML = '200 okay';
    const attributes = props.attributes;

    console.log( 'attributes', attributes );
    console.log( 'data', window.ftfDataviz[parseInt( attributes.dataSourceFileID )] );

    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'get_svg_map_html',
            map_style: attributes.mapStyle,
            map_area: attributes.mapArea,
            color_scheme: attributes.colorScheme,
            data_prefix: attributes.dataPrefix,
            data_suffix: attributes.dataSuffix,
            data_label: attributes.label,
            show_gridlines: attributes.showGridlines,
            data: window.ftfDataviz[parseInt( attributes.dataSourceFileID )]
        },
        type: 'POST',
        success: function( svgHTML ) {
            console.log( 'svgHTML', svgHTML )
            svgEl.innerHTML = svgHTML;
        }
    });

}

registerBlockType( 'ftf/dataviz-gutenberg-block', {
    title: __( 'Data visualization', 'ftf-dataviz-gutenberg-block' ),
    icon: 'chart-pie',
    category: 'widgets',
    keywords: [
        __( 'data', 'dataviz', 'visualization', 'chart', 'pie', 'bar', 'doughnut', 'radar', 'polar', 'map', 'table' ),
    ],    
    // supports: {
    //     align: true,
    // },
    attributes: {
        anchor: true,
        label: {
            type: 'string',
            default: ''
        },
        dataSource: {
            type: 'string',
            default: 'file'
        },
        dataLimit: {
            type: 'string'
        },        
        dataPrefix: {
            type: 'string',
            default: ''
        },        
        dataSuffix: {
            type: 'string',
            default: ''
        },        
        dataSourceURL: {
            type: 'string',
            default: ''
        },
        dataSourceFileID: {
            type: 'number',
            default: null
        },
        dataSourceFileURL: {
            type: 'string',
            default: ''
        },
        dataSourceFileName: {
            type: 'string',
            default: ''
        },
        dataColumns: {
            type: 'array',
            default: []
        },
        vizType: {
            type: 'string',
            default: 'bar'
        },
        mapStyle: {
            type: 'string',
            default: 'tile_grid'
        },
        mapArea: {
            type: 'string',
            default: 'US'
        },
        vizSize: {
            type: 'string',
            default: 'large'
        },
        useLogScale: {
            type: 'boolean',
            default: false
        },
        columnsAsFilters: {
            type: 'boolean',
            default: false
        },
        ignoreNullValues: {
            type: 'boolean',
            default: false
        },
        sortData: {
            type: 'boolean',
            default: false
        },
        color: {
            type: 'string',
            default: ''
        },
        colorScheme: {
            type: 'string',
            default: ''
        },
        showGridlines: {
            type: 'boolean',
            default: true
        },        
        chartConfigJSON: {
            type: 'string',
            default: ''
        },
        chartOptionsJSON: {
            type: 'string',
            default: ''
        },
        chartBorderText: {
            type: 'string',
            default: ''
        }
    },
    edit: class extends Component {
        constructor() {
            super(...arguments);
            this.state = {};
        }

        componentDidMount() {
            const clientId = this.props.clientId;

            const canvasEl = document.querySelector('[data-block="' + clientId + '"] canvas');
            const tableEl = document.querySelector('[data-block="' + clientId + '"] table');
            const svgEl = document.querySelector('[data-block="' + clientId + '"] .ftf-svg-placeholder');

            const props = this.props;

            if ( this.props.attributes.dataSourceFileID && ( typeof ftfDataviz === 'undefined' || !ftfDataviz[this.props.attributes.dataSourceFileID] ) ){
                console.log( 'fetching new data...', this.props.attributes );

                jQuery.ajax({
                    url: ajaxurl,
                    data: {
                        action: 'get_data',
                        attributes: this.props.attributes
                    },
                    type: 'POST',
                    success: function( data ) {
                        console.log( 'new data fetched', data );

                        window.ftfDataviz = window.ftfDataviz || {};
                        window.ftfDataviz[parseInt( data.source_file_id )] = data;

                        if ( canvasEl ){
                            ftfHelpers.renderChartAdmin( clientId, canvasEl );
                        }

                        if ( tableEl ){
                            ftfHelpers.renderTable( tableEl, props );
                        }

                        if ( svgEl ){
                            ftfHelpers.renderSVG( svgEl, props );
                        }                        
                    }
                });
            } else {
                console.log( 'found cached data...' );

                if ( canvasEl ){
                    ftfHelpers.renderChartAdmin( clientId, canvasEl );
                }

                if ( tableEl ){
                    ftfHelpers.renderTable( tableEl, props );
                }

                if ( svgEl ){
                    ftfHelpers.renderSVG( svgEl, props );
                }
            }

        }

        componentDidUpdate() {
            const selected = data.getSelectedBlock();
            const props = this.props;

            if ( this.props.isSelected ){
                const clientId = this.props.clientId;
                const canvasEl = document.querySelector('[data-block="' + clientId + '"] canvas');
                const tableEl = document.querySelector('[data-block="' + clientId + '"] table');
                const svgEl = document.querySelector('[data-block="' + clientId + '"] .ftf-svg-placeholder');

                if ( this.props.attributes.dataSourceFileID && ( typeof ftfDataviz === 'undefined' || !ftfDataviz[this.props.attributes.dataSourceFileID] ) ){
                    console.log( 'fetching new data...', this.props.attributes );

                    jQuery.ajax({
                        url: ajaxurl,
                        data: {
                            action: 'get_data',
                            attributes: this.props.attributes
                        },
                        type: 'POST',
                        success: function( data ) {
                            console.log( 'new data fetched', data );

                            window.ftfDataviz = window.ftfDataviz || {};
                            window.ftfDataviz[parseInt( data.source_file_id )] = data;

                            if ( canvasEl ){
                                ftfHelpers.renderChartAdmin( clientId, canvasEl );
                            }

                            if ( tableEl ){
                                ftfHelpers.renderTable( tableEl, props );
                            }

                            if ( svgEl ){
                                ftfHelpers.renderSVG( svgEl, props );
                            }                            
                        },
                    });
                } else {
                    console.log( 'found cached data...' );

                    if ( canvasEl ){
                        ftfHelpers.renderChartAdmin( clientId, canvasEl );
                    }

                    if ( tableEl ){
                        ftfHelpers.renderTable( tableEl, props );
                    }

                    if ( svgEl ){
                        ftfHelpers.renderSVG( svgEl, props );
                    }                    
                }
            }
        }

        // componentWillUnmount() {
        //     console.log(this.props.name, ": componentWillUnmount()");
        // }

        render() {

        const colorbrewer = ftfHelpers.colorPalettes;

        const {
            attributes: {
                label,
                dataSource,
                dataSourceURL,
                dataSourceFileID,
                dataSourceFileURL,
                dataSourceFileName,
                dataColumns,
                dataLimit,
                dataPrefix,
                dataSuffix,
                vizType,
                mapStyle,
                mapArea,
                vizSize,
                useLogScale,
                sortData,
                columnsAsFilters,
                ignoreNullValues,
                color,
                colorScheme,
                showGridlines,
                chartConfigJSON,
                chartOptionsJSON,
                chartBorderText,
                content
            },
            setAttributes,
            className,
        } = this.props;

        const setState = ( attr ) => {
            setAttributes( attr );
        };

        const colorSchemeOptions = [{
            label: 'Choose an option',
            value: '',
            disabled: true
        }];

        Object.keys( colorbrewer ).forEach( function( option ){
            colorSchemeOptions.push( {
                label: `${option} (${ Object.keys( colorbrewer[option] ).length + 2 })`,
                value: option,
            } );
        } );

        const ts = new Date().getTime();

        return [
            <InspectorControls>
                <PanelBody
                    title={ __( 'Data visualization', 'ftf-dataviz-gutenberg-block' ) }
                >
                    { dataSource !== 'config' && <SelectControl
                        label="Visualization type"
                        value={ vizType }
                        onChange={ ( vizType ) => setState( { vizType } ) }
                        options={ [
                            {
                                label: 'Choose an option',
                                value: '',
                                disabled: true
                            },
                            {
                                label: 'Bar chart',
                                value: 'bar'
                            },
                            {
                                label: 'Bar chart (Horizontal)',
                                value: 'horizontalBar'
                            },
                            {
                                label: 'Line chart',
                                value: 'line'
                            },
                            {
                                label: 'Scatter chart',
                                value: 'scatter'
                            },
                            {
                                label: 'Scatter chart with dates',
                                value: 'scatter-dates'
                            },
                            {
                                label: 'Pie chart',
                                value: 'pie'
                            },
                            {
                                label: 'Doughnut chart',
                                value: 'doughnut'
                            },
                            {
                                label: 'Polar area',
                                value: 'polarArea'
                            },
                            {
                                label: 'Radar chart',
                                value: 'radar'
                            },
                            // {
                            //     label: 'Map',
                            //     value: 'map'
                            // },
                            {
                                label: 'Table',
                                value: 'table'
                            }
                        ] }
                        help={ {
                            'scatter-dates': 'Date should be in the second column of your dataset.'
                        }[vizType] }

                    /> }
                    { vizType === 'map' && <div>
                    <SelectControl
                        label="Map style"
                        value={ mapStyle }
                        onChange={ ( mapStyle ) => setState( { mapStyle } ) }
                        options={ [
                            {
                                label: 'Choose an option',
                                value: '',
                                disabled: true
                            },                            
                            {
                                label: 'Tile grid',
                                value: 'tile_grid'

                            }
                        ] }
                    />
                    <SelectControl
                        label="Map ara"
                        value={ mapArea }
                        onChange={ ( mapArea ) => setState( { mapArea } ) }
                        options={ [
                            {
                                label: 'Choose an option',
                                value: '',
                                disabled: true
                            },                            
                            {
                                label: 'United States',
                                value: 'US'

                            }
                        ] }
                    />
                    </div> }                    
                    <div>
                    { dataSource !== 'config' &&
                            <SelectControl
                                label="Color scheme (Palette size)"
                                value={ colorScheme }
                                onChange={ ( colorScheme ) => setState( { colorScheme } ) }
                                options={ colorSchemeOptions }
                                help="Colors will be adjusted based on the size of the dataset and the visualization type."
                            />
                    }
                    { dataSource !== 'config' && ( colorbrewer && colorbrewer[colorScheme] && colorbrewer[colorScheme][8] ) && <div>
                        <div style={ { height: '40px', width: '100%', marginBottom: '20px', backgroundImage: colorScheme ? `linear-gradient(
                              to right,
                              ${colorbrewer[colorScheme][8][0]},
                              ${colorbrewer[colorScheme][8][0]} 12.5%,
                              ${colorbrewer[colorScheme][8][1]} 12.5%,
                              ${colorbrewer[colorScheme][8][1]} 25%,
                              ${colorbrewer[colorScheme][8][2]} 25%,
                              ${colorbrewer[colorScheme][8][2]} 37.5%,
                              ${colorbrewer[colorScheme][8][3]} 37.5%,
                              ${colorbrewer[colorScheme][8][3]} 50%,
                              ${colorbrewer[colorScheme][8][4]} 50%,
                              ${colorbrewer[colorScheme][8][4]} 62.5%,
                              ${colorbrewer[colorScheme][8][5]} 62.5%,
                              ${colorbrewer[colorScheme][8][5]} 75%,
                              ${colorbrewer[colorScheme][8][6]} 75%,
                              ${colorbrewer[colorScheme][8][6]} 87.5%,
                              ${colorbrewer[colorScheme][8][7]} 87.5%
                            )` : '', display: colorScheme ? 'block' : 'none' } } ></div>
                            <p>Via <a href="https://colorbrewer2.org/" target="_blank">colorbrewer2.org</a>.</p>
                        </div> }
                    </div>
                    { [ 'line', 'bar', 'horizontalBar', 'scatter', 'scatter-dates', 'map' ].indexOf( vizType ) !== -1 && 
                        <div>
                            <CheckboxControl
                                label="Show gridlines"
                                checked={ showGridlines }
                                onChange={ ( showGridlines ) => setState( { showGridlines } ) }
                            />
                        </div>
                    }
                    { dataSource !== 'config' && <SelectControl
                        label="Size"
                        value={ vizSize }
                        onChange={ ( vizSize ) => setState( { vizSize } ) }
                        options={ [
                            {
                                label: 'Choose an option',
                                value: '',
                                disabled: true
                            },                            
                            {
                                label: 'Small',
                                value: 'small'

                            },
                            {
                                label: 'Medium',
                                value: 'medium'

                            },
                            {
                                label: 'Large',
                                value: 'large'

                            }
                        ] }
                    /> }
                    { ( vizSize && ( vizSize === 'small' || vizSize === 'medium') ) &&
                        <p>
                            <strong><a href="/wp-admin/admin.php?page=ftf-dataviz-gutenberg-block" target="_blank">Update size settings</a></strong>
                        </p>
                    }
                    <SelectControl
                        label="Data source"
                        value={ dataSource }
                        onChange={ ( dataSource ) => setState( { dataSource } ) }
                        options={ [
                            {
                                label: 'Choose an option',
                                value: '',
                                disabled: true
                            },
                            {
                                label: 'Data file',
                                value: 'file'

                            },
                            // {
                            //     label: 'URL',
                            //     value: 'url',
                            //     disabled: true
                            // },
                            {
                                label: 'Configuration',
                                value: 'config'
                            }
                        ] }
                    />
                    { ( dataSource && dataSource === 'config' ) && <div>
                    <TextareaControl
                        label="Configuration object"
                        help="Enter the configuration object for your chart"
                        value={ chartConfigJSON }
                        onChange={ ( chartConfigJSON ) => setState( { chartConfigJSON } ) }
                    />
                    <p>See <a href="https://www.chartjs.org/docs/latest/getting-started/usage.html" target="_blank">chart.js documentation</a>.</p>
                    </div>
                    }
                    { ( dataSource && dataSource === 'url' ) && <TextControl
                        label="URL"
                        type="url"
                        value={ dataSourceURL }
                        onChange={ ( dataSourceURL ) => setState( { dataSourceURL } ) }
                    /> }
                    { ( dataSource && dataSource === 'file' && dataSourceFileName && window.ftfDataviz ) &&
                        <div>
                            <p>
                                <strong><a href={dataSourceFileURL} target="_blank">{dataSourceFileName}</a></strong>
                            </p>
                            {
                                false && window.ftfDataviz[parseInt( this.props.attributes.dataSourceFileID )] && window.ftfDataviz[parseInt( this.props.attributes.dataSourceFileID )]['axis_label_values'].map( label => {
                                    return ( <CheckboxControl
                                        label={ label }
                                        value={ label }
                                        checked={ dataColumns.indexOf( label ) !== -1 }
                                        onChange={ function( checked ){
                                            let dataColumnsValues = [];

                                            if ( checked && dataColumns.indexOf( label ) === -1 ){
                                                dataColumnsValues = dataColumns.filter(function(val){return true});
                                                dataColumnsValues.push( label );
                                            } else if ( !checked ){
                                                // dataColumnsValues = dataColumns.filter( function( val ){
                                                //     return val !== label;
                                                // } );
                                                dataColumns.forEach( function( val ){
                                                    if ( val !== label ){
                                                        dataColumnsValues.push( val );
                                                    }
                                                } );
                                            }

                                            return setState( { dataColumns: dataColumnsValues } );
                                        } }
                                /> )
                                } )
                            }
                        </div>
                    }
                    { ( dataSource && dataSource === 'file' ) && <TextControl
                        type="hidden"
                        value={ dataSourceFileID }
                    /> }
                    { ( dataSource && dataSource === 'file' ) && <MediaUpload 
                        allowedTypes={["text"]}
                        onSelect={ function( file ){
                            // console.log( 'selected ', file );
                            setState( {
                                dataSourceFileID: file.id,
                                dataSourceFileURL: file.url,
                                dataSourceFileName: file.filename
                            } );
                        } }
                        render={ ( { open } ) => (
                            <BaseControl>
                                <Button onClick={ open }
                                        className="button"
                                >
                                    Select data file
                                </Button>
                            </BaseControl>
                        ) }
                    /> }                    
                    { dataSource && dataSource !== 'config' && ( dataSourceURL || dataSourceFileID ) && <div>
                        <div>
                            <CheckboxControl
                                label="Hide columns with null values"
                                checked={ ignoreNullValues }
                                onChange={ ( ignoreNullValues ) => setState( { ignoreNullValues } ) }
                            />
                        </div>
                        <div>
                            <CheckboxControl
                                label="Sort by values in first column"
                                checked={ sortData }
                                onChange={ ( sortData ) => setState( { sortData } ) }
                            />
                        </div>
                        { sortData && <TextControl
                            label="Limit"
                            placeholder="10"
                            type="number"
                            help="Limit number of datapoints to top values and sort them."
                            value={ dataLimit }
                            onChange={ ( dataLimit ) => setState( { dataLimit } ) }
                        /> }
                        { false &&
                            <div>
                                <CheckboxControl
                                    label="Filter"
                                    help="Use columns after the first one to filter the data."
                                    checked={ columnsAsFilters }
                                    onChange={ ( columnsAsFilters ) => setState( { columnsAsFilters } ) }
                                />
                            </div>
                        }
                        <TextControl
                            label="Add prefix before value"
                            placeholder="$"
                            type="text"
                            value={ dataPrefix }
                            onChange={ ( dataPrefix ) => setState( { dataPrefix } ) }
                        />
                        <TextControl
                            label="Add suffix after value"
                            placeholder="%"
                            type="text"
                            value={ dataSuffix }
                            onChange={ ( dataSuffix ) => setState( { dataSuffix } ) }
                        />                        

                    </div> }
                    { dataSource !== 'config' && [ 'line', 'bar', 'horizontalBar', 'scatter', 'scatter-dates' ].indexOf( vizType ) !== -1 &&
                    <div>
                        <CheckboxControl
                            label="Use logarithmic scale"
                            help="Useful for datasets with a wide range of values."
                            checked={ useLogScale }
                            onChange={ ( useLogScale ) => setState( { useLogScale } ) }
                        />
                    </div>
                    }
                    { dataSource !== 'config' && <div>
                        <TextareaControl
                            label="Custom options"
                            help="Add custom options for your chart"
                            value={ chartOptionsJSON }
                            onChange={ ( chartOptionsJSON ) => setState( { chartOptionsJSON } ) }
                        />
                        <p>See <a href="https://www.chartjs.org/docs/latest/getting-started/usage.html" target="_blank">chart.js documentation</a>.</p>
                        </div>
                    }
                    <div>
                        <TextareaControl
                            label="Text border [EXPERIMENTAL]"
                            help="Add text border around your chart"
                            value={ chartBorderText }
                            onChange={ ( chartBorderText ) => setState( { chartBorderText } ) }
                        />
                    </div>
                </PanelBody>
            </InspectorControls>,
            <div>
                { ( !dataSource || ( dataSource === 'config' && !chartConfigJSON ) || ( dataSource === 'file' && !dataSourceFileID ) ) && <Placeholder icon="chart-pie" label="Data Visualization" instructions="" /> }
                { dataSource === 'file' && dataSourceFileID && [ 'line', 'bar', 'horizontalBar', 'pie', 'doughnut', 'polarArea', 'radar', 'scatter', 'scatter-dates' ].indexOf( vizType ) !== -1 && <canvas
                    class="ftf-dataviz-chart chart"
                    role="img"
                    aria-label={ label }
                    data-source-id={ dataSourceFileID }
                    data-label={ label }
                    data-log-scale={ useLogScale }
                    data-column-filter={ columnsAsFilters }
                    data-ignore-null={ ignoreNullValues }
                    data-sort={ sortData }
                    data-limit={ dataLimit }
                    data-prefix={ dataPrefix }
                    data-suffix={ dataSuffix }
                    data-axis-label-data={ label }
                    data-color-scheme={ colorScheme }
                    data-show-gridlines={ showGridlines }
                    data-type={ vizType }
                    data-options={ chartOptionsJSON }
                    data-border-text={ chartBorderText }
                ></canvas> }
                { dataSource === 'config' && chartConfigJSON && <canvas
                    class="ftf-dataviz-chart chart"
                    role="img"
                    data-config={ chartConfigJSON }
                ></canvas> }
                { dataSourceFileID && [ 'table' ].indexOf( vizType ) !== -1 &&
                    <table className="ftf-dataviz-table" border="0" cellpadding="5" width="100%" summary="This is the text alternative for the data visualization."></table>
                }
                { dataSourceFileID && [ 'map' ].indexOf( vizType ) !== -1 && <div class="ftf-svg-placeholder"></div> }
                { dataSource === 'file' && <RichText
                    tagName="p"
                    className={ className }
                    placeholder="Label"
                    onChange={ ( label ) => setAttributes( { label } ) }
                    value={ label }
                /> }
            </div>
        ];
    } }
} );
