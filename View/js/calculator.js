var btn = {
    del         : '#del_figure',
    result      : '#get_result',
    figure      : {
        cls             : '.figure',
        left_operand    : {Value: undefined},
        right_operand   : {Value: undefined}
    },
}

var arith = {
    cls         : '.arithmetic',
    Value       : undefined,
    obj         : undefined,
    selected    : false
}

var error_block = '#error_box';

var url = "../Controller/Receiver.php";

$(document).ready(function () {

    //Adding a blue button style for each button
    $("#calculator_block").find("input[type=button]").addClass("btn btn-info");

    /**
     * Set chosen number from 0 - 6
     */
    $(btn.figure.cls).bind("click", function () {

        var new_num = $(this).val();

        if (arith.selected == false) setFigure(btn.figure.left_operand, new_num);
        else setFigure(btn.figure.right_operand, new_num);

    });

    /**
     * Set chosen arithmetic action: + or - or *
     */
    $(arith.cls).bind("click", function () {
        if (getLeftOperand() !== undefined) {
            setArith($(this).val());
            arith.obj = $(this);
            setSelectedBorder();
            setArithStatus(true);
        }
    });

    /**
     * In each click deletes set data in further order: second_number, arith, first_number
     */
    $(btn.del).click(function () {

        if (getRightOperand() !== undefined) {
            setRightOperand(undefined);
            setSelectedBorder();
            updateResult(getLeftOperand());

        } else if (getArith() !== undefined) {
            setArith(undefined);
            setArithStatus(false);
            setDefaultBorder();

        } else if (getLeftOperand() !== undefined) {
            setLeftOperand(undefined);
            updateResult('');
        }

    });

    /**
     * Get result
     */
    $(btn.result).click(function () {

        removeError();

        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            dataType: "json",
            data: {
                first_num:  getLeftOperand(),
                second_num: getRightOperand(),
                arith:      getArith()
            },
            success: function (data) {
                if (data.error) {
                    setError(data.error);
                } else {

                    updateResult(data);
                    resetData();
                }
            },
            error: function () {
                setError("There is unexpected error, please try again or contact us");
            }
        })

    })
});

/**
 * Adding a new clicked number button to the existed one: first|second
 */
function setFigure(old_num, new_num) {

    if (old_num.Value == undefined || old_num.Value == "0") old_num.Value = new_num;
    else old_num.Value += '' + new_num;

    updateResult(old_num.Value);
    setDefaultBorder();

}

/**
 * Set default border for all arithmetic button
 */
function setDefaultBorder() {
    $(arith.cls).css("border", "1px solid #888b8b");
}

/**
 * Set thicker border for the clicked arithmetic button
 */
function setSelectedBorder() {
    setDefaultBorder();
    arith.obj.css("border", "1px solid #FF6400");
}

/**
 * Update result in the input field
 */
function updateResult(new_val) {
    $("#result").val(new_val);
}

/**
 * Resetting data with its initial values
 */
function resetData() {
    setLeftOperand(undefined);
    setRightOperand(undefined);
    setArith(undefined);
    setArithStatus(false);
    setDefaultBorder();
}

/**
 * Display error message
 * @param msg
 */
function setError(msg) {
    $(error_block).slideDown(300);
    $(error_block).html(msg);
}

/**
 * Remove error message
 */
function removeError() {
    $(error_block).slideUp(300);
    $(error_block).empty();
}

/**
 * Returns value of the first number
 *
 * @returns {*}
 */
function getLeftOperand(){
    return btn.figure.left_operand.Value;
}

/**
 * Sets new value of the first number
 *
 * @param new_val
 */
function setLeftOperand(new_val){
    btn.figure.left_operand.Value = new_val;
}

/**
 * Returns value of the second number
 *
 * @returns {*}
 */
function getRightOperand(){
    return btn.figure.right_operand.Value;
}

/**
 * Sets new value of the second number
 *
 * @param new_val
 */
function setRightOperand(new_val){
    btn.figure.right_operand.Value = new_val;
}

/**
 * Sets arithmetic status
 *
 * @param sts
 */
function setArithStatus(sts){
    arith.selected = sts;
}

/**
 * Sets new value of the arithmetic
 *
 * @param new_val
 */
function setArith(new_val){
    arith.Value = new_val;
}

/**
 * Returns value of the current arithmetic
 *
 * @returns {*}
 */
function getArith(){
    return arith.Value;
}
