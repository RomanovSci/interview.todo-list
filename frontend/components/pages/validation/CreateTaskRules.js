export const rules = {
    username: {
        presence: true,
        length: {
            minimum: 1,
            message: "can't be blank",
        },
    },
    email: {
        email: {
            message: 'is invalid',
        }
    },
    text: {
        presence: true,
        length: {
            minimum: 1,
            message: "can't be blank",
        }
    }
};