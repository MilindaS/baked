
$(function () {


  var Calculator = (function () {

      var operationData = (function () {

      var bi = BigInteger;
      bi.prototype.valueOf = bi.prototype.toString;
      
      return {
        add: {
          precedence: 1,
          name: 'add u1',
          operation: function (a, b) {return bi.add(a, b);},
          output: function (a, b) {return a + ' + ' + b;},
          buttonHTML: '+'
        },
        subtract: {
          precedence: 1,
          name: 'subtract u1',
          operation: function (a, b) {return bi.subtract(a, b);},
          output: function (a, b) {return a + ' - ' + b;},
          buttonHTML: '-'
        },
        multiply: {
          precedence: 2,
          name: 'multiply u1',
          operation: function (a, b) {return bi.multiply(a, b);},
          output: function (a, b) {return a + ' * ' + b;},
          buttonHTML: '*'
        },
        div: {
          precedence: 2,
          name: 'divide u1',
          operation: function (a, b) {return bi.quotient(a, b);},
          isInvalidInput: function (a, b) {return b == 0 ? 'division by 0' : false;},
          output: function (a, b) {return a + ' / ' + b;},
          buttonHTML: 'Div'
        },
        mod: {
          precedence: 2,
          name: 'modulo u1',
          operation: function (a, b) {return bi.remainder(a, b);},
          output: function (a, b) {return a + ' % ' + b;},
          buttonHTML: 'Mod'
        },
        negate: {
          precedence: 4,
          singleInput: true,
          name: 'negate u1',
          operation: function (a) {return bi.negate(a);},
          output: function (a) {return 'negate(' + a + ')';},
          buttonHTML: '&#177;'
        },
        square: {
          precedence: 4,
          singleInput: true,
          name: 'square u1',
          operation: function (a) {return bi.pow(a, 2);},
          output: function (a) {return 'sqr(' + a + ')';},
          buttonHTML: 'x<sup>2</sup>'
        },
        power: {
          precedence: 3,
          name: 'power u1',
          operation: function (a, b) {return bi.pow(a, b);},
          output: function (a, b) {return a + ' ^ ' + b;},
          buttonHTML: 'x<sup>y</sup>'
        },
        exp10: {
          precedence: 4,
          name: 'exp10 u1',
          operation: function (a, b) {return bi.exp10(a, b);},
          output: function (a, b) {return '(' + a + ' * 10^' + b + ')';},
          buttonHTML: '*10<sup>y</sup>'
        },
        context: {
          precedence: 5,
          singleInput: true,
          name: 'context u1',
          operation: function (a) {return a;},
          output: function (a) {return '(' + a + ')';}
        }
      };
    }());



    

    var Operation = function (options) {
    
      var inputs = [];
    
      for (var key in options) {
        this[key] = options[key];
      };
      
      this.addInput = function (input) {
        if (this.isSaturated()) return this;
        inputs.push(input);
        return this;
      };
    
      this.isInvalidInput = this.isInvalidInput || function () {return false;};
    
      this.isSaturated = function () {
        var inputCount = this.singleInput ? 1 : 2;
        for (var i = 0; i < inputCount; ++i) {
          if (inputs[i] == null) return false;
        }
        return true;
      };
    
      this.execute = function () {
        if (this.error) return this;
        if ( ! this.isSaturated() || this.value != null) return this;
        var inputValues = inputs.map(function (input) {return input.valueOf();});
        this.error = this.isInvalidInput.apply(this, inputValues); 
        if (this.error) {
          throw new Error(this.error);
        }
        this.calculationString = this.getCalculationString(); 
        this.value = this.operation.apply(this, inputValues);
        return this;
      };
    
      this.getCalculationString = function (lastInput, collapsed) {
        if (collapsed) {
          this.execute();
          if (this.value != null) return this.value.toString();
        }
        var singleInput = this.singleInput;
        var inputValues = inputs.map(function (input) {
          var inputValue = input.getCalculationString ?
            input.getCalculationString(lastInput, collapsed) :
            input.toString();
          return singleInput ? inputValue.replace(/^\((.*)\)$/g, '$1') : inputValue;
        });
        return options.output.apply(this, inputValues.concat([lastInput]));
      };
    
      this.valueOf = function () {
        if (this.value == null) {
          this.execute();
        }
        return this.value;
      };

      this.toString = function () {
        if (this.calculationString == null) {
          this.execute();
        }
        return this.getCalculationString();
      };
    };
    



    
    var InputStack = (function () {
      
      var levels, closedContext, partialResult, error;

      var Stack = function () {
        this.peek = function () {return this[this.length - 1];};
      };
      Stack.prototype = [];
      
      var reset = function () {
        levels = new Stack;
        levels.push(new Stack);
        closedContext = error = null;
      };

      var wrapLastOperation = function (operation) {
        var stack = levels.peek();
        stack.push(operation.addInput(stack.pop()));
        collapse(operation.precedence);
      };

      var collapse = function (precedence) {
        var stack = levels.peek();
        var currentOperation = stack.pop();
        var previousOperation = stack.peek();
        
        if ( ! currentOperation) return;

        if ( ! currentOperation.isSaturated()) {
          stack.push(currentOperation);
          return;
        }
        
        try {
          partialResult = currentOperation.valueOf();
        }
        catch (e) {
          partialResult = error = 'Error: ' + e.message;
        }

        if (previousOperation && previousOperation.precedence >= precedence) {
          previousOperation.addInput(currentOperation);
          collapse(precedence);
        }
        else {
          stack.push(currentOperation);
        }
      };

      reset();

      return {
        push: function (number, operation) {
          error && reset();
          var stack = levels.peek();
          var lastOperation = stack.peek();
          var input = closedContext || number;
          closedContext = null;
          partialResult = input.valueOf();
          if ( ! lastOperation || operation.precedence > lastOperation.precedence) {
            stack.push(operation.addInput(input));
            collapse(operation.precedence);
          }
          else {
            lastOperation.addInput(input);
            collapse(operation.precedence);
            wrapLastOperation(operation);
          }
          return this;
        },
        openContext: function () {
          error && reset();
          var lastOperation = levels.peek().peek();
          if (closedContext || lastOperation && lastOperation.isSaturated()) return;
          levels.push(new Stack);
          return this;
        },
        closeContext: function (number) {
          error && reset();
          if (levels.length <= 1) return;
          var input = closedContext || number;
          var stack = levels.peek();
          var lastOperation = stack.peek();
          closedContext = new Operation(operationData.context).addInput(
            lastOperation ? (function () {
              lastOperation.addInput(input);
              collapse(0);
              return stack.pop();
            }()) : input
          );
          partialResult = closedContext.valueOf();
          levels.pop();
          return this;
        },
        evaluate: function (number) {
          error && reset();
          var input = closedContext || number;
          partialResult = input.valueOf();
          while (levels.length > 1) {
            this.closeContext(input);
          }
          var lastOperation = levels.peek().peek(); 
          lastOperation && lastOperation.addInput(input);
          collapse(0);
          reset();
          return this;
        },
        getPartialResult: function () {
          var _partialResult = partialResult;
          partialResult = 0;
          return _partialResult.toString();
        },
        getCalculationString: function (collapsed) {
          var result = closedContext ? closedContext.getCalculationString('', collapsed) : '';
          for (var j = levels.length - 1; j >= 0; --j) {
            for (var i = levels[j].length - 1; i >= 0; --i) {
              result = levels[j][i].getCalculationString(result, collapsed);
            }
            if (j > 0) {
              result = '(' + result;
            }
          }
          return result;
        }
      };
      
    }());





    $.fn.addButton = function (html, className, onclick) {
      $('<div/>', {
        html: html,
        'class': 'button ' + className,
        click: onclick
      }).appendTo(this);
      return this;
    };

    var addNumberButton = function (number) {
      $numbers.addButton(number, 'number ' + (number == '.' ? 'dot' : 'number-' + number), function () {
        if ($input.text().match(/\./) && number == '.') return;
        if ($input.text() == '0' && number != '.' || $input.data('clearOnInput')) {
          $input.text('');
        }
        $input.data({clearOnInput: false});
        $input.text($input.text() + $(this).text());
      });
    };
    
    var addOperationButton = function (operation, click) {
      $operations.addButton(operation.buttonHTML, 'operation ' + operation.name, function (e) {
        click.call(this, e);
        $calculation.text(InputStack.getCalculationString());
        $collapsedCalculation.text(InputStack.getCalculationString(true));
        $input.text(InputStack.getPartialResult());
        $input.data({clearOnInput: true});
      });
    };

    var getInput = function () {
      var input = $input.text();
      return input.match(/error/i) ? 0 : BigInteger($input.text());
    };

    var i;
    var $calculator = $('#calculator');
    var $ioField = $('<div/>', {'class': 'io-field'}).appendTo($calculator);
    var $calculation = $('<div/>', {'class': 'calculation'}).appendTo($ioField);
    var $collapsedCalculation = $('<div/>', {'class': 'collapsed-calculation'}).appendTo($ioField);
    var $input = $('<div/>', {'class': 'input', text: 0}).appendTo($ioField);
    var $keyboardInput = $('<input/>').appendTo($calculator)
      .focus().css({opacity: 0, position: 'absolute', top: 0});
    var $numbers = $('<div/>', {'class': 'numbers'}).appendTo($calculator);
    var $operations = $('<div/>', {'class': 'operations'}).appendTo($calculator);

    $calculator.click(function () {
      $keyboardInput.focus();
    });

    $(window).keydown(function (e) {
      setTimeout(function () {
        var val = $keyboardInput.val();
        $keyboardInput.val('');
        switch (e.keyCode) {
          case 13: $('.button.evaluate').click(); break;
          case 110: case 188: case 190: $('.button.dot').click(); break;
          case 8: $('.button.del').click(); break;
          case 46: $('.button.clear-entry').click(); break;
          case 27: $('.button.clear').click(); break;
          default:
            $calculator.find('.button').each(function () {
              if (val == $(this).text()) {
                $(this).click();
              }
            });
        }
      }, 0);
    });

    $numbers.addButton('&larr;', 'del button-blue', function () {
      $input.text($input.text().replace(/.$/, ''));
      $input.text().length || $input.text('0');
    });
    $numbers.addButton('CE', 'clear-entry', function () {
      $input.text('0');
    });
    $numbers.addButton('C', 'clear', function () {
      $('#calculator .evaluate').click();
      $input.text('0');
    });
    $.each('7894561230.'.split(''), function () {
      addNumberButton(this.toString());
    });
    
    addOperationButton({buttonHTML: '(', name: 'openContext u1'}, function () {
      InputStack.openContext();
    });
    addOperationButton({buttonHTML: ')', name: 'closeContext u1'}, function () {
      InputStack.closeContext(getInput());
    });
    for (i in operationData) {
      (function (i) {
        if ( ! operationData[i].buttonHTML) return;
        addOperationButton(operationData[i], function () {
          InputStack.push(getInput(), new Operation(operationData[i]));
        });
      }(i));
    }
    addOperationButton({buttonHTML: '=', name: 'evaluate u2 button-red'}, function () {
      InputStack.evaluate(getInput());
    });

    
  }());


});