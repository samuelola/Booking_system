//when you use export this is publicly available for use
export const is404 = function (err) {
    return err.response && err.response.status == 404;
}

export const is422 = function (error) {
   return  error.response && error.response.status == 422;
}

export const is500 = function (err) {
    return err.response && err.response.status == 500;
}

const isErrorWithResponseAndStatus = function (err) {
    return err.response && err.response.status;
}