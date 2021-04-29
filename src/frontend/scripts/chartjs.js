'use strict';

function ready( fn ) {
    if ( document.readyState != 'loading' ){
        fn();
    } else {
        document.addEventListener( 'DOMContentLoaded', fn );
    }
}

window.ftfHelpers = window.ftfHelpers || {};

ftfHelpers.isMobile = function(){
    var check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
}

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
    if ( !hex ){
        return null;
    }
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

    let chartOptions = {};

    if ( chartEl.dataset.config ){
        try{
            // chartOptions = JSON.parse( chartEl.dataset.config );
            chartOptions = eval( '(' + chartEl.dataset.config + ')' );
        } catch( err ){ console.log( err ) /* noop */ }
    } else{
        let colorSchemeIndex = 3;
        let datavizType = chartEl.dataset.type || 'bar';

        let chartLabels, chartData;
        if ( chartEl.dataset.sourceId ){
            if ( datavizType === 'scatter' ){
                chartLabels = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_labels_raw ) );
                chartData = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_series_raw ) );
            }
            else if ( datavizType === 'scatter-dates' ){
                chartData = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_labels_raw ) );
                chartLabels = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_series_raw ) );
            }
            else if ( chartEl.dataset.sort && chartEl.dataset.sort === 'true' ){
                chartLabels = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_labels_sorted ) );
                chartData = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_series_sorted ) );
            } else {
                chartLabels = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_labels ) );
                chartData = JSON.parse( JSON.stringify( window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_series ) );
            }            
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

        if ( chartData && chartData.length > 3 ){
            colorSchemeIndex = chartData.length;
        }

        const dataRows = chartData ? chartData[0].length : 0;
        let datasets = [];

        for( let i = 0; i < dataRows; i++ ){
            let dataArray = [];
            let label = '';

            chartData.forEach( function( data, index ){
                if ( chartEl.dataset.sourceId ){
                    label = window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].axis_label_values[i];                    
                }

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

            if ( chartEl.dataset.colorScheme ){
                if ( chartEl.dataset.colorScheme && ftfHelpers.colorPalettes[chartEl.dataset.colorScheme] ){
                    if ( [ 'bar', 'horizontalBar' ].indexOf( datavizType ) !== -1 ){
                        dataset.backgroundColor = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows+3][i];
                    } else if ( datavizType === 'line' ){
                        dataset.borderColor = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows+3][i];
                        dataset.fill = false;
                    }
                }

            }

            datasets.push( dataset );
        }

        if ( chartEl.dataset.columnFilter && chartEl.dataset.columnFilter === 'true' ){
            for ( let i = 1; i < datasets.length; i++ ){
                let selectHtml = `<label>${datasets[i].label}
                    <select name="ftf-dataviz-filter-${ chartEl.dataset.sourceId }" id="ftf-dataviz-filter-${ chartEl.dataset.sourceId }">
                      ${
                        datasets[i].data.map( function( data ){
                            return `<option value="option">option</option>`;
                        } )
                      }
                    </select>
                </label>`; 
            }
        
            datasets = [datasets[0]];
        }

        chartOptions = {
            type: datavizType,
            data: {
                labels: chartLabels,
                datasets: datasets
            },
            options: {}
        };

        let axesLabels, axesValues;

        switch ( datavizType ){
            case 'horizontalBar':
            case 'bar':
            case 'line':
                axesLabels = [{
                    scaleLabel: {
                        display: true,
                        // labelString: chartEl.dataset.axisLabelData
                        labelString: chartEl.dataset.sourceId ? window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].axis_label_title : ''
                    },
                    ticks: {
                        beginAtZero: true,
                        // userCallback: function( value, index, values)  {
                        //     return value.toLocaleString();
                        // }
                    }
                }];

                axesValues = [{
                    scaleLabel: {
                        display: true,
                        labelString: chartEl.dataset.label
                    },
                    type: chartEl.dataset.logScale && chartEl.dataset.logScale === '1' ? 'logarithmic' : 'linear',
                    ticks: {
                        beginAtZero: true,
                        autoSkip: true,
                        min: 0,
                        userCallback: function( value, index, values)  {
                            return chartEl.dataset.prefix + value.toLocaleString() + chartEl.dataset.suffix;
                        }
                    },
                    afterBuildTicks: (chartObj) => {
                        const dataValues = [].concat.apply( [], datasets.map( function( datapoint ){
                            return datapoint.data;
                        } ) ).map( function( v ){
                            return Math.pow( 10, Math.floor( v ).toString().length - 1 );
                        } );

                        if ( ftfHelpers.isMobile() ){
                            chartObj.ticks.splice(0, chartObj.ticks.length);
                        }

                        chartObj.ticks.push(...dataValues);
                    }                    
                }];

                if ( chartEl.dataset.logScale && chartData.length > 4 ){
                    /* Temporary fix for labels overlapping when using logarithmic scale. */
                    // axesValues[0].ticks.minRotation = 30;
                    axesValues[0].ticks.maxTicksLimit = chartData.length * 3;
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

                if ( chartEl.dataset.colorScheme && ftfHelpers.colorPalettes[chartEl.dataset.colorScheme] ){
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

                        if ( chartEl.dataset.colorScheme ){
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

                        if ( chartEl.dataset.colorScheme ){
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
            case 'scatter':
            case 'scatter-dates':
                const labelX = chartEl.dataset.sourceId ? window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].axis_label_title : '',
                      labelY = chartOptions.data.datasets[0].label;

                let selectedColorScheme;

                if ( chartEl.dataset.colorScheme && chartOptions.data.datasets[0] ){
                    if ( ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows] ){
                        selectedColorScheme = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][dataRows];
                    } else {
                        selectedColorScheme = ftfHelpers.colorPalettes[chartEl.dataset.colorScheme][Object.keys( ftfHelpers.colorPalettes[chartEl.dataset.colorScheme] ).length - 3];
                    }


                    chartOptions.data.datasets[0].backgroundColor = ftfHelpers.convertHex( selectedColorScheme[0], 20 );
                    chartOptions.data.datasets[0].borderColor = ftfHelpers.convertHex( selectedColorScheme[0], 40 );
                    chartOptions.data.datasets[0].hoverBorderColor = ftfHelpers.convertHex( ftfHelpers.pSBC( -0.05, ftfHelpers.invertColor( selectedColorScheme[0] ) ), 40 );
                }

                chartOptions.data.datasets[0].hoverBorderWidth = 4;
                chartOptions.data.datasets[0].borderWidth = 4;

                axesLabels = [{
                    scaleLabel: {
                        display: true,
                        // labelString: chartEl.dataset.axisLabelData
                        labelString: chartEl.dataset.sourceId ? window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].axis_label_title : ''
                    },
                    ticks: {
                        // max: 3,
                        // beginAtZero: true,
                        // userCallback: function( value, index, values)  {
                        //     return value.toLocaleString();
                        // }
                    }
                }];

                axesValues = [{
                    scaleLabel: {
                        display: true,
                        labelString: labelY
                    },
                    type: chartEl.dataset.logScale && chartEl.dataset.logScale === '1' ? 'logarithmic' : 'linear',
                    ticks: {
                        // beginAtZero: true,
                        userCallback: function( value, index, values)  {
                            return chartEl.dataset.prefix + value.toLocaleString() + chartEl.dataset.suffix;
                        }
                    }
                }];   
                
                chartOptions.options.scales = {
                    xAxes: axesValues,
                    yAxes: axesLabels
                };  

                let datapoints = [];
                chartOptions.data.labels.forEach( function( dataset, i ){

                    let datapoint = { x: null, y: null };

                    if ( datavizType === 'scatter-dates' ){
                        chartOptions.type = 'scatter';
                        chartOptions.options.scales = {
                            'xAxes': [
                                {
                                   'type': 'time',
                                   'position': 'bottom',
                                   'ticks': {
                                        beginAtZero: false,
                                        stepSize: 10,

                                        callback: (value) => {
                                          return new Date( value ).toLocaleDateString( navigator.language, { month: 'long', year: 'numeric' } );
                                        },
                                    }
                                }
                            ],
                            yAxes: [
                                {
                                    ticks: {
                                        beginAtZero: false,
                                        display: false
                                    },
                                    scaleLabel: {
                                        display: false,
                                        // labelString: chartEl.dataset.axisLabelData
                                        // labelString: chartEl.dataset.sourceId ? window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].axis_label_title : ''
                                        // labelString: 'Day of the month'
                                    },
                                    minorTickInterval: null
                                }
                            ]
                        };

                        chartOptions.options.legend = {
                            display: false
                        };

                        const d = new Date( chartOptions.data.labels[i] );
                        datapoint.x = d;

                        // Day of the month
                        datapoint.y = d.getDate();

                        // datapoint.y = i;
                        // datapoint.y = 0;

                    } else {
                        datapoint.x = parseFloat( chartOptions.data.labels[i] );
                        datapoint.y = parseFloat( chartOptions.data.datasets[0].data[i] );
                    }

                    datapoints.push( datapoint );
                } );
                chartOptions.data.datasets[0].data = datapoints;
                chartOptions.data.datasets = [chartOptions.data.datasets[0]];
                chartOptions.options.tooltips = {
                  callbacks: {
                    title: function(tooltipItem, data) {
                      return new Date( data['labels'][tooltipItem[0]['index']] ).toLocaleDateString( navigator.language, { day: 'numeric', month: 'long', year: 'numeric' } );

                    },
                    label: function( tooltipItem, data ) {
                        return chartEl.dataset.prefix + window.ftfDataviz[parseInt( chartEl.dataset.sourceId )].data_labels_raw[tooltipItem['index']] + chartEl.dataset.suffix;
                    }
                  }
                }                
                break;
        }

    }

    if ( !chartEl.dataset.showGridlines || chartEl.dataset.showGridlines.toString() === 'false' ){
        chartOptions.options.scales = chartOptions.options.scales  || {};
        chartOptions.options.scales.xAxes = chartOptions.options.scales.xAxes  || [];
        chartOptions.options.scales.yAxes = chartOptions.options.scales.yAxes  || [];

        chartOptions.options.scales.xAxes.forEach( function( xAxis ){
            xAxis.gridLines = {
            display: true,
            drawBorder: true,
            drawOnChartArea: false,
            };
        } );

        chartOptions.options.scales.yAxes.forEach( function( yAxis ){
            yAxis.gridLines = {
            display: true,
            drawBorder: true,
            drawOnChartArea: false,
            };
        } );
    }
    if ( chartEl.dataset.options ){
        try{
            chartOptions.options = eval( '(' + chartEl.dataset.options + ')' );
        } catch( err ){ console.log( err ) /* noop */ }
    }

    if ( ftfHelpers.isMobile() ){
        let svgBorder = chartEl.parentElement.querySelector( 'svg' );

        if ( svgBorder ){
            svgBorder.setAttribute( 'viewBox', '0 0 500 500' );
            svgBorder.querySelector( 'path' ).setAttribute( 'd', 'M 0 0  H 500 V 500 H 0 L 0 0' );
            svgBorder.querySelector( 'textPath' ).style.fontSize = '24px';
        }
        chartEl.height = chartEl.width;
    }

    if ( chartOptions ){
        // console.log( 'rendering chart...', chartEl, chartOptions );
        // console.log( 'data', chartOptions.data.datasets );

        try{
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
        } catch( err ){ /* noop */ }
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
    let sliders = document.querySelectorAll( '.ftf-dataviz-slider-container' );

    for ( const slider of sliders ) {
      slider.addEventListener( 'input', function( ev ){
        const dataVizEl = ev.target.closest( '.ftf-dataviz' );

        // console.log( 'dataVizEl', dataVizEl );
        // console.log( 'ev.target', ev.target );
        // console.log( 'ev.target.dataset.data', ev.target.dataset.data );

        dataVizEl.querySelector( '.ftf-dataviz-slider-title' ).innerHTML = ev.target.value;

        const mapData = JSON.parse( ev.target.dataset.data );
        const dataIndex = ev.target.value - ev.target.min;

        let datapoints = {};

        mapData.forEach( function( datapoint ){
            datapoints[datapoint[0]] = datapoint[dataIndex+1]
        } );

        // console.log( 'datapoints', datapoints );

        for ( const dataRow in datapoints ){
            if ( dataRow && dataRow.length > 0 ){

                let value;

                if ( datapoints[dataRow] ){
                    value = ev.target.dataset.prefix + datapoints[dataRow] + ev.target.dataset.suffix;
                } else {
                    value = datapoints[dataRow];
                }

                dataVizEl.querySelector( `rect.state.${ dataRow }` ).parentElement.querySelectorAll('text')[1].textContent = value;
            }
        }

        // console.log( {
        //     min: ev.target.min,
        //     max: ev.target.max,
        //     value: ev.target.value,
        //     index: dataIndex,
        //     prefix: ev.target.dataset.prefix,
        //     suffix: ev.target.dataset.suffix,
        //     data: mapData
        // } );
      } );
    }
} );

// document.querySelector( 'rect.state.NY' );