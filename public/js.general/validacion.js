/**
 * If the length of the number is 10, then we split the number into an array, then we loop through the array and add the numbers to a
 * sum variable, if the index of the array is even, then we multiply the number by 2, if the number is greater than 9, then we
 * subtract 9 from the number, if the number is less than 9, then we add the number to the sum, if the index of the array is odd,
 * then we add the number to the sum, then we check if the sum is divisible by 10, if it is, then we return true, if it isn't, then
 * we return false.
 * @param num - The cedula number
 * @returns A function that takes a number as a parameter and returns true or false depending on whether the number is a valid cedula
 * or not.
 */
const isCedula = (num) => {
    if (num.length == 10) {
        let sum = 0;
        let cedula = num.split("");
        for (let i = 0; i < cedula.length; i++) {
            let temp = parseInt(cedula[i]);
            if (i % 2 == 0) {
                if (temp * 2 > 9) {
                    sum += temp * 2 - 9;
                } else {
                    sum += temp * 2;
                }
            } else {
                sum += temp;
            }
        }
        if (sum % 10 == 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
};

/**
 * If the length of the number is 13, then add the digits together, and if the sum is divisible by 10, and the last three digits are
 * between 001 and 003, then return true, otherwise return false.
 * @param num - The number to be validated
 * @returns A function that takes a number as a parameter and returns true if it is a valid RUC number.
 */
const isRuc = (num) => {
    if (num.length == 13) {
        let sum = 0;
        let cedula = num.split("");
        for (let i = 0; i < 10; i++) {
            let temp = parseInt(cedula[i]);
            if (i % 2 == 0) {
                if (temp * 2 > 9) {
                    sum += temp * 2 - 9;
                } else {
                    sum += temp * 2;
                }
            } else {
                sum += temp;
            }
        }
        if (sum % 10 == 0) {
            if (cedula[10] == 0 && cedula[11] == 0 && cedula[12] > 0 && cedula[12] < 4) {
                return true;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
};

/**
 * It takes an email address as a parameter and returns true if it's a valid email address and false if it's not.
 * @param email - The email address to validate.
 * @returns A boolean value.
 */
const isEmail = (email) => {
    let mail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (mail.test(email)) {
        return true;
    } else {
        return false;
    }
};

/**
 * It returns true if the string passed to it matches the pattern of a phone number, and false if it doesn't.
 * @param Ncelular - The phone number to be validated.
 * @returns A function that takes a string and returns a boolean.
 */
const isCelular = (Ncelular) => {
    let celular = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

    if (celular.test(Ncelular)) {
        return true;
    } else {
        return false;
    }
};
/**
 * If the string is a valid phone number, return true, otherwise return false.
 * @param Ncelular - The phone number to validate
 * @returns A boolean value.
 */
const isTelefono = (Ncelular) => {
    let celular = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

    if (celular.test("593" + Ncelular)) {
        return true;
    } else {
        return false;
    }
};

/**
 * It checks if a value exists in a database, and if it does, it checks if the value is not the same as the value being checked.
 * @param dataBase - the array of objects
 * @param dataCol - the value of the column you want to check
 * @param dataColName - The name of the column in the database that you want to check for duplicates.
 * @param dataCol_id - the id of the data column
 * @param dataCol_name_id - the name of the column that contains the id of the dataCol_name
 * @returns A boolean value.
 */
const existData = (dataBase, dataCol, dataColName, dataCol_id, dataCol_name_id) => {
    for (let i of dataBase) {
        if (i[dataColName] == dataCol && i[dataCol_name_id] != dataCol_id) {
            return true;
        }
    }
    return false;
};

/**
 * If the dataName property of any object in the databaseTable array is equal to the dataValue parameter, return false, otherwise
 * return true.
 * @param databaseTable - The table you want to check
 * @param dataValue - The value of the data you want to delete.
 * @param dataName - The name of the data you want to check.
 * @returns A boolean value.
 */
const isDeleteable = (databaseTable, dataValue, dataName) => {
    for (let i of databaseTable) {
        if (i[dataName] == dataValue) {
            return false;
        }
    }
    return true;
};
