'use strict';

function ready( fn ) {
    if ( document.readyState != 'loading' ){
        fn();
    } else {
        document.addEventListener( 'DOMContentLoaded', fn );
    }
}

window.ftfHelpers = window.ftfHelpers || {};

ftfHelpers.convertHex = function( hex, opacity ){
    /* https://gist.github.com/danieliser/b4b24c9f772066bcf0a6 */
    if (!hex){
        hex = '#000000';
    }

    hex = hex.replace( '#','' );

    let r, g, b;

    r = parseInt( hex.substring( 0,2 ), 16 );
    g = parseInt( hex.substring( 2,4 ), 16 );
    b = parseInt( hex.substring( 4,6 ), 16 );

    let result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
    return result;
}

ftfHelpers.pSBC = function(p,c0,c1,l){
    let r,g,b,P,f,t,h,i=parseInt,m=Math.round,a=typeof(c1)=="string";
    if(typeof(p)!="number"||p<-1||p>1||typeof(c0)!="string"||(c0[0]!='r'&&c0[0]!='#')||(c1&&!a))return null;
    if(!this.pSBCr)this.pSBCr=(d)=>{
        let n=d.length,x={};
        if(n>9){
            [r,g,b,a]=d=d.split(","),n=d.length;
            if(n<3||n>4)return null;
            x.r=i(r[3]=="a"?r.slice(5):r.slice(4)),x.g=i(g),x.b=i(b),x.a=a?parseFloat(a):-1
        }else{
            if(n==8||n==6||n<4)return null;
            if(n<6)d="#"+d[1]+d[1]+d[2]+d[2]+d[3]+d[3]+(n>4?d[4]+d[4]:"");
            d=i(d.slice(1),16);
            if(n==9||n==5)x.r=d>>24&255,x.g=d>>16&255,x.b=d>>8&255,x.a=m((d&255)/0.255)/1000;
            else x.r=d>>16,x.g=d>>8&255,x.b=d&255,x.a=-1
        }return x};
    h=c0.length>9,h=a?c1.length>9?true:c1=="c"?!h:false:h,f=this.pSBCr(c0),P=p<0,t=c1&&c1!="c"?this.pSBCr(c1):P?{r:0,g:0,b:0,a:-1}:{r:255,g:255,b:255,a:-1},p=P?p*-1:p,P=1-p;
    if(!f||!t)return null;
    if(l)r=m(P*f.r+p*t.r),g=m(P*f.g+p*t.g),b=m(P*f.b+p*t.b);
    else r=m((P*f.r**2+p*t.r**2)**0.5),g=m((P*f.g**2+p*t.g**2)**0.5),b=m((P*f.b**2+p*t.b**2)**0.5);
    a=f.a,t=t.a,f=a>=0||t>=0,a=f?a<0?t:t<0?a:a*P+t*p:0;
    if(h)return"rgb"+(f?"a(":"(")+r+","+g+","+b+(f?","+m(a*1000)/1000:"")+")";
    else return"#"+(4294967296+r*16777216+g*65536+b*256+(f?m(a*255):0)).toString(16).slice(1,f?undefined:-2)
}

ftfHelpers.invertColor = function( hex, bw ) {
    if ( hex.indexOf( '#' ) === 0 ) {
        hex = hex.slice( 1 );
    }

    if ( hex.length === 3 ) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }

    var r = parseInt( hex.slice( 0, 2 ), 16 ),
        g = parseInt( hex.slice( 2, 4 ), 16 ),
        b = parseInt( hex.slice( 4, 6 ), 16 );

    if ( bw ) {
        return ( r * 0.299 + g * 0.587 + b * 0.114 ) > 186
            ? '#000000'
            : '#FFFFFF';
    }

    r = ( 255 - r ).toString( 16 );
    g = ( 255 - g ).toString( 16 );
    b = ( 255 - b ).toString( 16 );

    return '#' + ftfHelpers.padZero( r ) + ftfHelpers.padZero( g ) + ftfHelpers.padZero( b );
}

ftfHelpers.padZero = function( str, len ) {
    len = len || 2;
    var zeros = new Array( len ).join( '0' );
    return ( zeros + str ).slice( -len );
}

ftfHelpers.renderChart = function( chartEl ){
    if ( !chartEl ){ return false; }

    let colorSchemeIndex = 3;
    let datavizType = chartEl.dataset.type || 'bar';

    let chartLabels, chartData;

    if ( chartEl.dataset.sort && chartEl.dataset.sort === 'true' ){
        chartLabels = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_labels_sorted ) );
        chartData = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_series_sorted ) );
    } else {
        chartLabels = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_labels ) );
        chartData = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_series ) );
    }

    if ( chartEl.dataset.ignoreNull && chartEl.dataset.ignoreNull === 'true' ){

        chartData.forEach( function( datapoints, indexOuter ){
            let removeDatapoint = true;

            datapoints.forEach( function( datapoint, indexInner ){
                if ( chartData[indexOuter][indexInner] && parseInt( chartData[indexOuter][indexInner] ) !== 0 ){
                    removeDatapoint = false;
                }
            } );

            if ( removeDatapoint ){
                delete chartData[indexOuter];
                delete chartLabels[indexOuter];
            }
        } );

        chartData = chartData.filter( function ( item ){ return item != undefined } );
        chartLabels = chartLabels.filter( function ( item ){ return item != undefined } );
    }


    if ( chartEl.dataset.sort && chartEl.dataset.sort === 'true' && chartEl.dataset.limit ){
        chartLabels = chartLabels.slice( 0, chartEl.dataset.limit );
        chartData = chartData.slice( 0, chartEl.dataset.limit );
    }

    if ( chartData.length > 3 ){
        colorSchemeIndex = chartData.length;
    }

    const dataRows = chartData[0].length;
    let datasets = [];

    for( let i = 0; i < dataRows; i++ ){
        let dataArray = [];
        let label = '';

        chartData.forEach( function( data, index ){
            label = window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].axis_label_values[i];

            // const label = chartData[i][index];
            dataArray.push( chartData[index][i] );
        } );

        let dataset = {
            label: label,
            data: dataArray,
            __custom_meta: {
                prefix: chartEl.dataset.prefix,
                suffix: chartEl.dataset.suffix
            }
        };

        if ( chartEl.dataset.colorScheme && ftfHelpers.colorPalettes[chartEl.dataset.colorScheme] ){
            if ( [ 'bar', 'horizontalBar' ].indexOf( datavizType ) !== -1 ){
                dataset.backgroundColor = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows+3][i];
            } else if ( datavizType === 'line' ){
                dataset.borderColor = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows+3][i];
                dataset.fill = false;
            }
        }

        datasets.push( dataset );
    }

    if ( chartEl.dataset.columnFilter && chartEl.dataset.columnFilter === 'true' ){
        console.log( 'datasets', datasets );

        for ( let i = 1; i < datasets.length; i++ ){
            console.log( 'data map', datasets[i] );
            let selectHtml = `<label>${datasets[i].label}
                <select name="ftf-dataviz-filter-${ chartEl.dataset.sourceId }" id="ftf-dataviz-filter-${ chartEl.dataset.sourceId }">
                  ${
                    datasets[i].data.map( function( data ){
                        console.log( 'data map', data );
                        return `<option value="option">option</option>`;
                    } )
                  }
                </select>
            </label>`; 

            console.log( 'dataset ' + i, datasets[i] );
            console.log( 'selectHtml', selectHtml );

        }
    
        datasets = [datasets[0]];
    }

    let chartOptions = {
        type: datavizType,
        data: {
            labels: chartLabels,
            datasets: datasets
        },
        options: {}
    };

    switch ( datavizType ){
        case 'horizontalBar':
        case 'bar':
        case 'line':
            const axesLabels = [{
                scaleLabel: {
                    display: true,
                    // labelString: chartEl.dataset.axisLabelData
                    labelString: window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].axis_label_title
                },
                ticks: {
                    beginAtZero: true,
                    // userCallback: function( value, index, values)  {
                    //     return value.toLocaleString();
                    // }
                }
            }];

            const axesValues = [{
                scaleLabel: {
                    display: true,
                    labelString: chartEl.dataset.label
                },
                type: chartEl.dataset.logScale ? 'logarithmic' : 'linear',
                ticks: {
                    beginAtZero: true,
                    userCallback: function( value, index, values)  {
                        return chartEl.dataset.prefix + value.toLocaleString() + chartEl.dataset.suffix;
                    }
                }
            }];

            if ( chartEl.dataset.logScale && chartData.length > 4 ){
                /* Temporary fix for labels overlapping when using logarithmic scale. */
                // axesValues[0].ticks.minRotation = 30;
                axesValues[0].ticks.maxTicksLimit = chartData.length;
            }

            if ( ftfHelpers.isAdmin() ){
                // axesValues[0].ticks.maxTicksLimit = chartData.length;
                axesValues[0].ticks.maxTicksLimit = 4;
            }

            if ( datavizType === 'horizontalBar' ){
                chartOptions.options.scales = {
                    xAxes: axesValues,
                    yAxes: axesLabels
                };

                chartOptions.options.tooltips = {
                  callbacks: {
                    label: function( tooltipItem, data ) {
                        return data['datasets'][0]['__custom_meta']['prefix'] + tooltipItem.xLabel.toLocaleString() + data['datasets'][0]['__custom_meta']['suffix'];
                    }
                  }
                }

            } else {
                chartOptions.options.scales = {
                    xAxes: axesLabels,
                    yAxes: axesValues
                };

                chartOptions.options.tooltips = {
                  callbacks: {
                    title: function(tooltipItem, data) {
                        return data.datasets[tooltipItem[0].datasetIndex].label;
                    },
                    label: function( tooltipItem, data ) {
                        return `${data.labels[tooltipItem.index]}: ${data['datasets'][0]['__custom_meta']['prefix']}${tooltipItem.yLabel.toLocaleString()}${data['datasets'][0]['__custom_meta']['suffix']}`;
                    }
                  }
                }
            }

            chartOptions.options.responsive = true;
            
            if ( ftfHelpers.colorPalettes[chartEl.dataset.colorScheme] ){
                chartOptions.data.datasets.forEach( function( dataset, index ){
                    dataset.hoverBorderWidth = 4;
                    dataset.hoverBorderColor = ftfHelpers.pSBC( -0.05, ftfHelpers.invertColor( ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows+3][index] ) );
                    dataset.borderWidth = 4;
                } );

            }

            break;
        case 'pie':
        case 'doughnut':
        case 'polarArea':
            for( let i = 0; i < dataRows; i++ ){
                if ( chartOptions.data && chartOptions.data.datasets[i] ){
                    let selectedColorScheme;

                    if ( ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][chartLabels.length] ){
                        selectedColorScheme = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][chartLabels.length];
                    } else {

                        selectedColorScheme = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][Object.keys( ftfHelpers.colorPalettes[chartEl.dataset.colorScheme] ).length - 3];
                    }

                    chartOptions.data.datasets[i].backgroundColor = selectedColorScheme;
                    chartOptions.data.datasets[i].hoverBorderColor = selectedColorScheme.map( function( color ){
                        return ftfHelpers.pSBC( -0.05, ftfHelpers.invertColor( color ) );
                    } );

                    chartOptions.data.datasets[i].hoverBorderWidth = 4;
                    chartOptions.data.datasets[i].borderWidth = 4;
                }
            }

            chartOptions.options.tooltips = {
              callbacks: {
                title: function(tooltipItem, data) {
                    return data['labels'][tooltipItem[0]['index']];
                },
                label: function( tooltipItem, data ) {
                    return data['datasets'][0]['__custom_meta']['prefix'] + parseInt( data['datasets'][0]['data'][tooltipItem['index']] ).toLocaleString() + data['datasets'][0]['__custom_meta']['suffix'];
                }
              }
            }

            break;
        case 'radar':
            for( let i = 0; i < dataRows; i++ ){
                if ( chartOptions.data && chartOptions.data.datasets[i] ){
                

                    let selectedColorScheme;

                    if ( ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows] ){
                        selectedColorScheme = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows];
                    } else {
                        selectedColorScheme = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][Object.keys( ftfHelpers.colorPalettes[chartEl.dataset.colorScheme] ).length - 3];
                    }

                    // chartOptions.data.datasets[i].fill = 'start';
                    chartOptions.data.datasets[i].backgroundColor = ftfHelpers.convertHex( selectedColorScheme[i], 20 );
                    chartOptions.data.datasets[i].borderColor = ftfHelpers.convertHex( selectedColorScheme[i], 40 );
                    chartOptions.data.datasets[i].hoverBorderColor = ftfHelpers.convertHex( ftfHelpers.pSBC( -0.05, ftfHelpers.invertColor( selectedColorScheme[i] ) ), 40 );

                    chartOptions.data.datasets[i].hoverBorderWidth = 4;
                    chartOptions.data.datasets[i].borderWidth = 4;
                }
            }

            chartOptions.options.tooltips = {
              callbacks: {
                title: function(tooltipItem, data) {
                    return data['labels'][tooltipItem[0]['index']];
                },
                label: function( tooltipItem, data ) {
                    return data['datasets'][0]['__custom_meta']['prefix'] + parseInt( data['datasets'][0]['data'][tooltipItem['index']] ).toLocaleString() + data['datasets'][0]['__custom_meta']['suffix'];
                }
              }
            }

            break;
    }

    // console.log( 'rendering chart...', chartEl, chartOptions );

    let newChart = new Chart( chartEl, chartOptions );

    if ( !ftfHelpers.isAdmin() ){
        /* Chart.js accessibility via https://codepen.io/kurkle/pen/WNrwjMp */

        let selectedIndex = -1;
        const meta = newChart.getDatasetMeta( 0 );

        function clearActive() {
            if (selectedIndex > -1) {
                meta.controller.removeHoverStyle( meta.data[selectedIndex], 0, selectedIndex );
            }
        }

        function activate() {
            meta.controller.setHoverStyle( meta.data[selectedIndex], 0, selectedIndex );
            newChart.render();
        }

        function activateNext() {
            clearActive();
            selectedIndex = (selectedIndex + 1) % meta.data.length;
            activate();
        }

        function activatePrev() {
            clearActive();
            selectedIndex = ( selectedIndex || meta.data.length ) -1;
            activate();
        }

        chartEl.addEventListener( 'focus', function(){
            if (selectedIndex === -1) {
                activateNext();
            } else {
                activate();
            }
        } );

        chartEl.addEventListener( 'blur', function(){
            clearActive();
            newChart.render();
        } );

        chartEl.addEventListener( 'keydown', function( e ) {
            if ( e.key === 'ArrowRight' ) {
                activateNext();
            } else if ( e.key === 'ArrowLeft' ) {
                activatePrev();
            }
        } );
    }

}

ftfHelpers.isAdmin = function(){
    const wpAdmin = document.getElementsByClassName( 'wp-admin' );
    return wpAdmin && wpAdmin.length;
}

ready( function(){
    let charts = document.getElementsByClassName( 'ftf-dataviz-chart' );
    Array.from( charts ).forEach( function( chartEl ){
        ftfHelpers.renderChart( chartEl );
    } );
} );
