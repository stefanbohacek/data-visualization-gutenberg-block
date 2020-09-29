/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/assertThisInitialized.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

module.exports = _assertThisInitialized;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/classCallCheck.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/classCallCheck.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

module.exports = _classCallCheck;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/createClass.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createClass.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

module.exports = _createClass;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/getPrototypeOf.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _getPrototypeOf(o) {
  module.exports = _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
    return o.__proto__ || Object.getPrototypeOf(o);
  };
  return _getPrototypeOf(o);
}

module.exports = _getPrototypeOf;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/inherits.js":
/*!*********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/inherits.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var setPrototypeOf = __webpack_require__(/*! ./setPrototypeOf */ "./node_modules/@babel/runtime/helpers/setPrototypeOf.js");

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function");
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      writable: true,
      configurable: true
    }
  });
  if (superClass) setPrototypeOf(subClass, superClass);
}

module.exports = _inherits;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js":
/*!**************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var _typeof = __webpack_require__(/*! ../helpers/typeof */ "./node_modules/@babel/runtime/helpers/typeof.js");

var assertThisInitialized = __webpack_require__(/*! ./assertThisInitialized */ "./node_modules/@babel/runtime/helpers/assertThisInitialized.js");

function _possibleConstructorReturn(self, call) {
  if (call && (_typeof(call) === "object" || typeof call === "function")) {
    return call;
  }

  return assertThisInitialized(self);
}

module.exports = _possibleConstructorReturn;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/setPrototypeOf.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/setPrototypeOf.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _setPrototypeOf(o, p) {
  module.exports = _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };

  return _setPrototypeOf(o, p);
}

module.exports = _setPrototypeOf;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/typeof.js":
/*!*******************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/typeof.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) {
  "@babel/helpers - typeof";

  if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
    module.exports = _typeof = function _typeof(obj) {
      return typeof obj;
    };
  } else {
    module.exports = _typeof = function _typeof(obj) {
      return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    };
  }

  return _typeof(obj);
}

module.exports = _typeof;

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @babel/runtime/helpers/inherits */ "./node_modules/@babel/runtime/helpers/inherits.js");
/* harmony import */ var _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/helpers/possibleConstructorReturn */ "./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js");
/* harmony import */ var _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @babel/runtime/helpers/getPrototypeOf */ "./node_modules/@babel/runtime/helpers/getPrototypeOf.js");
/* harmony import */ var _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__);







function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _babel_runtime_helpers_getPrototypeOf__WEBPACK_IMPORTED_MODULE_4___default()(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _babel_runtime_helpers_possibleConstructorReturn__WEBPACK_IMPORTED_MODULE_3___default()(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }






var Component = wp.element.Component;
var data = wp.data.select('core/block-editor');
window.ftfHelpers = window.ftfHelpers || {};

window.ftfHelpers.renderChartAdmin = function (clientId, canvasEl) {
  canvasEl.id = 'ftf-dataviz-chart-' + clientId;
  Chart.helpers.each(Chart.instances, function (instance) {
    if ('ftf-dataviz-chart-' + clientId === instance.chart.canvas.id) {
      instance.destroy();
    }
  });
  window.ftfHelpers.renderChart(canvasEl);
};

window.ftfHelpers.renderTable = function (tableEl, props) {
  var tableHTML = "<tbody>\n        <tr>\n        <th scope=\"col\" style=\"text-align:left\">".concat(window.ftfDataviz[parseInt(props.attributes.dataSourceFileID)]['axis_label_title'], "\n    </th>");
  window.ftfDataviz[parseInt(props.attributes.dataSourceFileID)]['axis_label_values'].map(function (label, i) {
    tableHTML += "<th scope=\"col\" style=\"text-align:right\">".concat(label, "</th>");
  });
  tableHTML += '</tr>';

  if (!props.attributes.sortData) {
    window.ftfDataviz[parseInt(props.attributes.dataSourceFileID)]['data_series'].forEach(function (datapoint, index) {
      var keepDatapoint = true;

      if (props.attributes.ignoreNullValues) {
        keepDatapoint = false;

        if (datapoint && parseFloat(datapoint) !== 0) {
          keepDatapoint = true;
        }
      }

      if (keepDatapoint) {
        tableHTML += "<tr>\n                    <th scope=\"row\" style=\"text-align:right\">\n                        ".concat(window.ftfDataviz[parseInt(props.attributes.dataSourceFileID)]['data_labels'][index], "\n                    </th>");
        window.ftfDataviz[parseInt(props.attributes.dataSourceFileID)]['data_series'][index].forEach(function (item) {
          tableHTML += "<td style=\"text-align:right\">".concat(props.attributes.dataPrefix).concat(parseInt(item).toLocaleString()).concat(props.attributes.dataSuffix, "</td>");
        });
        tableHTML += '</tr>';
      }
    });
  }

  props.attributes.sortData && window.ftfDataviz[parseInt(props.attributes.dataSourceFileID)]['data_series_sorted'].forEach(function (datapoint, index) {
    var keepDatapoint = true;

    if (props.attributes.ignoreNullValues) {
      keepDatapoint = false;

      if (datapoint && parseFloat(datapoint) !== 0) {
        keepDatapoint = true;
      }
    }

    if (keepDatapoint && (!props.attributes.dataLimit || props.attributes.dataLimit && index < props.attributes.dataLimit)) {
      tableHTML += "<tr>\n                <th scope=\"row\" style=\"text-align:left\">\n                    ".concat(window.ftfDataviz[parseInt(props.attributes.dataSourceFileID)]['data_labels_sorted'][index], "\n                </th>");
      window.ftfDataviz[parseInt(props.attributes.dataSourceFileID)]['data_series_sorted'][index].forEach(function (item) {
        tableHTML += "<td style=\"text-align:right\">".concat(props.attributes.dataPrefix).concat(parseInt(item).toLocaleString()).concat(props.attributes.dataSuffix, "</td>");
      });
      tableHTML += '</tr>';
    }
  });
  tableEl.innerHTML = tableHTML + '</tbody>';
};

Object(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_7__["registerBlockType"])('ftf/dataviz-gutenberg-block', {
  title: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__["__"])('Data visualization', 'ftf-dataviz-gutenberg-block'),
  icon: 'chart-pie',
  category: 'widgets',
  keywords: [Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__["__"])('data', 'dataviz', 'visualization', 'chart', 'pie', 'bar', 'doughnut', 'radar', 'polar', 'table')],
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
    }
  },
  edit: /*#__PURE__*/function (_Component) {
    _babel_runtime_helpers_inherits__WEBPACK_IMPORTED_MODULE_2___default()(edit, _Component);

    var _super = _createSuper(edit);

    function edit() {
      var _this;

      _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, edit);

      _this = _super.apply(this, arguments);
      _this.state = {};
      return _this;
    }

    _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(edit, [{
      key: "componentDidMount",
      value: function componentDidMount() {
        var clientId = this.props.clientId;
        var canvasEl = document.querySelector('[data-block="' + clientId + '"] canvas');
        var tableEl = document.querySelector('[data-block="' + clientId + '"] table');
        var props = this.props;

        if (this.props.attributes.dataSourceFileID && (typeof ftfDataviz === 'undefined' || !ftfDataviz[this.props.attributes.dataSourceFileID])) {
          console.log('fetching new data...', this.props.attributes);
          jQuery.ajax({
            url: ajaxurl,
            data: {
              action: 'get_data',
              attributes: this.props.attributes
            },
            type: 'POST',
            success: function success(data) {
              console.log('new data fetched', data);
              window.ftfDataviz = window.ftfDataviz || {};
              window.ftfDataviz[parseInt(data.source_file_id)] = data;

              if (canvasEl) {
                ftfHelpers.renderChartAdmin(clientId, canvasEl);
              }

              if (tableEl) {
                ftfHelpers.renderTable(tableEl, props);
              }
            }
          });
        } else {
          console.log('found cached data...');

          if (canvasEl) {
            ftfHelpers.renderChartAdmin(clientId, canvasEl);
          }

          if (tableEl) {
            ftfHelpers.renderTable(tableEl, props);
          }
        }
      }
    }, {
      key: "componentDidUpdate",
      value: function componentDidUpdate() {
        var selected = data.getSelectedBlock();
        var props = this.props;

        if (this.props.isSelected) {
          var clientId = this.props.clientId;
          var canvasEl = document.querySelector('[data-block="' + clientId + '"] canvas');
          var tableEl = document.querySelector('[data-block="' + clientId + '"] table');

          if (this.props.attributes.dataSourceFileID && (typeof ftfDataviz === 'undefined' || !ftfDataviz[this.props.attributes.dataSourceFileID])) {
            console.log('fetching new data...', this.props.attributes);
            jQuery.ajax({
              url: ajaxurl,
              data: {
                action: 'get_data',
                attributes: this.props.attributes
              },
              type: 'POST',
              success: function success(data) {
                console.log('new data fetched', data);
                window.ftfDataviz = window.ftfDataviz || {};
                window.ftfDataviz[parseInt(data.source_file_id)] = data;

                if (canvasEl) {
                  ftfHelpers.renderChartAdmin(clientId, canvasEl);
                }

                if (tableEl) {
                  ftfHelpers.renderTable(tableEl, props);
                }
              }
            });
          } else {
            console.log('found cached data...');

            if (canvasEl) {
              ftfHelpers.renderChartAdmin(clientId, canvasEl);
            }

            if (tableEl) {
              ftfHelpers.renderTable(tableEl, props);
            }
          }
        }
      } // componentWillUnmount() {
      //     console.log(this.props.name, ": componentWillUnmount()");
      // }

    }, {
      key: "render",
      value: function render() {
        var colorbrewer = ftfHelpers.colorPalettes;
        var _this$props = this.props,
            _this$props$attribute = _this$props.attributes,
            label = _this$props$attribute.label,
            dataSource = _this$props$attribute.dataSource,
            dataSourceURL = _this$props$attribute.dataSourceURL,
            dataSourceFileID = _this$props$attribute.dataSourceFileID,
            dataSourceFileURL = _this$props$attribute.dataSourceFileURL,
            dataSourceFileName = _this$props$attribute.dataSourceFileName,
            dataColumns = _this$props$attribute.dataColumns,
            dataLimit = _this$props$attribute.dataLimit,
            dataPrefix = _this$props$attribute.dataPrefix,
            dataSuffix = _this$props$attribute.dataSuffix,
            vizType = _this$props$attribute.vizType,
            vizSize = _this$props$attribute.vizSize,
            useLogScale = _this$props$attribute.useLogScale,
            sortData = _this$props$attribute.sortData,
            columnsAsFilters = _this$props$attribute.columnsAsFilters,
            ignoreNullValues = _this$props$attribute.ignoreNullValues,
            color = _this$props$attribute.color,
            colorScheme = _this$props$attribute.colorScheme,
            showGridlines = _this$props$attribute.showGridlines,
            chartConfigJSON = _this$props$attribute.chartConfigJSON,
            chartOptionsJSON = _this$props$attribute.chartOptionsJSON,
            content = _this$props$attribute.content,
            setAttributes = _this$props.setAttributes,
            className = _this$props.className;

        var setState = function setState(attr) {
          setAttributes(attr);
        };

        var colorSchemeOptions = [{
          label: 'Choose an option',
          value: '',
          disabled: true
        }];
        Object.keys(colorbrewer).forEach(function (option) {
          colorSchemeOptions.push({
            label: "".concat(option, " (").concat(Object.keys(colorbrewer[option]).length + 2, ")"),
            value: option
          });
        });
        var ts = new Date().getTime();
        return [Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_8__["InspectorControls"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["PanelBody"], {
          title: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__["__"])('Data visualization', 'ftf-dataviz-gutenberg-block')
        }, dataSource !== 'config' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["SelectControl"], {
          label: "Visualization type",
          value: vizType,
          onChange: function onChange(vizType) {
            return setState({
              vizType: vizType
            });
          },
          options: [{
            label: 'Choose an option',
            value: '',
            disabled: true
          }, {
            label: 'Bar chart',
            value: 'bar'
          }, {
            label: 'Bar chart (Horizontal)',
            value: 'horizontalBar'
          }, {
            label: 'Line chart',
            value: 'line'
          }, {
            label: 'Scatter chart',
            value: 'scatter'
          }, {
            label: 'Scatter chart with dates',
            value: 'scatter-dates'
          }, {
            label: 'Pie chart',
            value: 'pie'
          }, {
            label: 'Doughnut chart',
            value: 'doughnut'
          }, {
            label: 'Polar Area',
            value: 'polarArea'
          }, {
            label: 'Radar chart',
            value: 'radar'
          }, {
            label: 'Table',
            value: 'table'
          }],
          help: {
            'scatter-dates': 'Date should be in the second column of your dataset.'
          }[vizType]
        }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, dataSource !== 'config' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["SelectControl"], {
          label: "Color scheme (Palette size)",
          value: colorScheme,
          onChange: function onChange(colorScheme) {
            return setState({
              colorScheme: colorScheme
            });
          },
          options: colorSchemeOptions,
          help: "Colors will be adjusted based on the size of the dataset and the visualization type."
        }), dataSource !== 'config' && colorbrewer && colorbrewer[colorScheme] && colorbrewer[colorScheme][8] && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", {
          style: {
            height: '40px',
            width: '100%',
            marginBottom: '20px',
            backgroundImage: colorScheme ? "linear-gradient(\n                              to right,\n                              ".concat(colorbrewer[colorScheme][8][0], ",\n                              ").concat(colorbrewer[colorScheme][8][0], " 12.5%,\n                              ").concat(colorbrewer[colorScheme][8][1], " 12.5%,\n                              ").concat(colorbrewer[colorScheme][8][1], " 25%,\n                              ").concat(colorbrewer[colorScheme][8][2], " 25%,\n                              ").concat(colorbrewer[colorScheme][8][2], " 37.5%,\n                              ").concat(colorbrewer[colorScheme][8][3], " 37.5%,\n                              ").concat(colorbrewer[colorScheme][8][3], " 50%,\n                              ").concat(colorbrewer[colorScheme][8][4], " 50%,\n                              ").concat(colorbrewer[colorScheme][8][4], " 62.5%,\n                              ").concat(colorbrewer[colorScheme][8][5], " 62.5%,\n                              ").concat(colorbrewer[colorScheme][8][5], " 75%,\n                              ").concat(colorbrewer[colorScheme][8][6], " 75%,\n                              ").concat(colorbrewer[colorScheme][8][6], " 87.5%,\n                              ").concat(colorbrewer[colorScheme][8][7], " 87.5%\n                            )") : '',
            display: colorScheme ? 'block' : 'none'
          }
        }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("p", null, "Via ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("a", {
          href: "https://colorbrewer2.org/",
          target: "_blank"
        }, "colorbrewer2.org"), "."))), ['line', 'bar', 'horizontalBar', 'scatter', 'scatter-dates'].indexOf(vizType) !== -1 && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["CheckboxControl"], {
          label: "Show gridlines",
          checked: showGridlines,
          onChange: function onChange(showGridlines) {
            return setState({
              showGridlines: showGridlines
            });
          }
        })), dataSource !== 'config' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["SelectControl"], {
          label: "Size",
          value: vizSize,
          onChange: function onChange(vizSize) {
            return setState({
              vizSize: vizSize
            });
          },
          options: [{
            label: 'Choose an option',
            value: '',
            disabled: true
          }, {
            label: 'Small',
            value: 'small'
          }, {
            label: 'Medium',
            value: 'medium'
          }, {
            label: 'Large',
            value: 'large'
          }]
        }), vizSize && (vizSize === 'small' || vizSize === 'medium') && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("strong", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("a", {
          href: "/wp-admin/admin.php?page=ftf-dataviz-gutenberg-block",
          target: "_blank"
        }, "Update size settings"))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["SelectControl"], {
          label: "Data source",
          value: dataSource,
          onChange: function onChange(dataSource) {
            return setState({
              dataSource: dataSource
            });
          },
          options: [{
            label: 'Choose an option',
            value: '',
            disabled: true
          }, {
            label: 'Data file',
            value: 'file'
          }, // {
          //     label: 'URL',
          //     value: 'url',
          //     disabled: true
          // },
          {
            label: 'Configuration',
            value: 'config'
          }]
        }), dataSource && dataSource === 'config' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["TextareaControl"], {
          label: "Configuration object",
          help: "Enter the configuration object for your chart",
          value: chartConfigJSON,
          onChange: function onChange(chartConfigJSON) {
            return setState({
              chartConfigJSON: chartConfigJSON
            });
          }
        }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("p", null, "See ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("a", {
          href: "https://www.chartjs.org/docs/latest/getting-started/usage.html",
          target: "_blank"
        }, "chart.js documentation"), ".")), dataSource && dataSource === 'url' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["TextControl"], {
          label: "URL",
          type: "url",
          value: dataSourceURL,
          onChange: function onChange(dataSourceURL) {
            return setState({
              dataSourceURL: dataSourceURL
            });
          }
        }), dataSource && dataSource === 'file' && dataSourceFileName && window.ftfDataviz && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("p", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("strong", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("a", {
          href: dataSourceFileURL,
          target: "_blank"
        }, dataSourceFileName))),  false && false), dataSource && dataSource === 'file' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["TextControl"], {
          type: "hidden",
          value: dataSourceFileID
        }), dataSource && dataSource === 'file' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_8__["MediaUpload"], {
          allowedTypes: ["text"],
          onSelect: function onSelect(file) {
            // console.log( 'selected ', file );
            setState({
              dataSourceFileID: file.id,
              dataSourceFileURL: file.url,
              dataSourceFileName: file.filename
            });
          },
          render: function render(_ref) {
            var open = _ref.open;
            return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["BaseControl"], null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["Button"], {
              onClick: open,
              className: "button"
            }, "Select data file"));
          }
        }), dataSource && dataSource !== 'config' && (dataSourceURL || dataSourceFileID) && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["CheckboxControl"], {
          label: "Hide columns with null values",
          checked: ignoreNullValues,
          onChange: function onChange(ignoreNullValues) {
            return setState({
              ignoreNullValues: ignoreNullValues
            });
          }
        })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["CheckboxControl"], {
          label: "Sort by values in first column",
          checked: sortData,
          onChange: function onChange(sortData) {
            return setState({
              sortData: sortData
            });
          }
        })), sortData && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["TextControl"], {
          label: "Limit",
          placeholder: "10",
          type: "number",
          help: "Limit number of datapoints to top values and sort them.",
          value: dataLimit,
          onChange: function onChange(dataLimit) {
            return setState({
              dataLimit: dataLimit
            });
          }
        }),  false && false, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["TextControl"], {
          label: "Add prefix before value",
          placeholder: "$",
          type: "text",
          value: dataPrefix,
          onChange: function onChange(dataPrefix) {
            return setState({
              dataPrefix: dataPrefix
            });
          }
        }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["TextControl"], {
          label: "Add suffix after value",
          placeholder: "%",
          type: "text",
          value: dataSuffix,
          onChange: function onChange(dataSuffix) {
            return setState({
              dataSuffix: dataSuffix
            });
          }
        })), dataSource !== 'config' && ['line', 'bar', 'horizontalBar', 'scatter', 'scatter-dates'].indexOf(vizType) !== -1 && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["CheckboxControl"], {
          label: "Use logarithmic scale",
          help: "Useful for datasets with a wide range of values.",
          checked: useLogScale,
          onChange: function onChange(useLogScale) {
            return setState({
              useLogScale: useLogScale
            });
          }
        })), dataSource !== 'config' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["TextareaControl"], {
          label: "Custom options",
          help: "Add custom options for your chart",
          value: chartOptionsJSON,
          onChange: function onChange(chartOptionsJSON) {
            return setState({
              chartOptionsJSON: chartOptionsJSON
            });
          }
        }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("p", null, "See ", Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("a", {
          href: "https://www.chartjs.org/docs/latest/getting-started/usage.html",
          target: "_blank"
        }, "chart.js documentation"), ".")))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("div", null, (!dataSource || dataSource === 'config' && !chartConfigJSON || dataSource === 'file' && !dataSourceFileID) && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_9__["Placeholder"], {
          icon: "chart-pie",
          label: "Data Visualization",
          instructions: ""
        }), dataSource === 'file' && dataSourceFileID && ['line', 'bar', 'horizontalBar', 'pie', 'doughnut', 'polarArea', 'radar', 'scatter', 'scatter-dates'].indexOf(vizType) !== -1 && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("canvas", {
          class: "ftf-dataviz-chart chart",
          role: "img",
          "aria-label": label,
          "data-source-id": dataSourceFileID,
          "data-label": label,
          "data-log-scale": useLogScale,
          "data-column-filter": columnsAsFilters,
          "data-ignore-null": ignoreNullValues,
          "data-sort": sortData,
          "data-limit": dataLimit,
          "data-prefix": dataPrefix,
          "data-suffix": dataSuffix,
          "data-axis-label-data": label,
          "data-color-scheme": colorScheme,
          "data-show-gridlines": showGridlines,
          "data-type": vizType,
          "data-options": chartOptionsJSON
        }), dataSource === 'config' && chartConfigJSON && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("canvas", {
          class: "ftf-dataviz-chart chart",
          role: "img",
          "data-config": chartConfigJSON
        }), dataSourceFileID && ['table'].indexOf(vizType) !== -1 && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])("table", {
          className: "ftf-dataviz-table",
          border: "0",
          cellpadding: "5",
          width: "100%",
          summary: "This is the text alternative for the data visualization."
        }), dataSource === 'file' && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__["createElement"])(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_8__["RichText"], {
          tagName: "p",
          className: className,
          placeholder: "Label",
          onChange: function onChange(label) {
            return setAttributes({
              label: label
            });
          },
          value: label
        }))];
      }
    }]);

    return edit;
  }(Component)
});

/***/ }),

/***/ "@wordpress/block-editor":
/*!**********************************************!*\
  !*** external {"this":["wp","blockEditor"]} ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["blockEditor"]; }());

/***/ }),

/***/ "@wordpress/blocks":
/*!*****************************************!*\
  !*** external {"this":["wp","blocks"]} ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["blocks"]; }());

/***/ }),

/***/ "@wordpress/components":
/*!*********************************************!*\
  !*** external {"this":["wp","components"]} ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["components"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!******************************************!*\
  !*** external {"this":["wp","element"]} ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["element"]; }());

/***/ }),

/***/ "@wordpress/i18n":
/*!***************************************!*\
  !*** external {"this":["wp","i18n"]} ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = this["wp"]["i18n"]; }());

/***/ })

/******/ });
//# sourceMappingURL=index.js.map