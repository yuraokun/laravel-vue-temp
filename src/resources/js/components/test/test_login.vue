<template>
    <div>
        <h1>Login</h1>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo
            corrupti accusantium porro iusto, molestias architecto aperiam, hic
            ipsum minima sunt, tenetur perferendis optio odit repellat quia
            corporis debitis nobis ab!
        </p>

        <div>
            <div>
                email
                <input type="email" v-model="email" />
            </div>
            <div>
                password
                <input type="password" v-model="password" />
            </div>
            <div>
                <button v-if="!is_login" @click="login">login</button>
                <button v-else @click="logout">logout</button>
                <button @click="getMsg">get Messages</button>
            </div>
        </div>
        <hr />
        <div v-if="!is_login">
            <h1>Register</h1>
            <div>
                <div>
                    email
                    <input type="email" v-model="r_email" />
                </div>
                <div>
                    password
                    <input type="password" v-model="r_password" />
                </div>

                <div>
                    password confirmation
                    <input type="password" v-model="r_password_confirmation" />
                </div>
                <div>
                    <button @click="register">register</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            email: null,
            password: null,
            r_email: null,
            r_password: null,
            r_password_confirmation: null,
            is_login: false,
            user_data: null,
            token: null
        };
    },
    async beforeCreate() {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post("/login", {
            email: "test@gmail.com",
            password: "12345"
        });
        const user = await axios.get("/user").then(res => {
            console.log(user);
        });
    },

    methods: {
        login: function() {
            axios
                .post("/sanctum/csrf-cookie", {
                    email: this.email,
                    password: this.password,
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(response => {
                    if (response.data.api_token) {
                        this.user_data = response.data.user_data;
                        this.token = response.data.api_token;
                        this.is_login = true;
                        console.log(this.is_login);
                    }
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        getMsg: function() {
            // axios.get("/sanctum/csrf-cookie").then(res => console.log(res));
            axios
                .get("/api/user/getMsg")
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        register: function() {
            axios
                .post("/api/user/register", {
                    email: this.r_email,
                    password: this.r_password,
                    password_confirmation: this.r_password
                })
                .then(function(response) {
                    if (response.data.api_token) {
                        this.user_data = response.data.user_data;
                        this.token = response.data.api_token;
                        this.is_login = true;
                    }
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        logout: function() {
            axios
                .get("/api/user/logout", {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                })
                .then(response => {
                    (this.token = null), (this.user_data = null);
                    this.is_login = false;
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>

<style></style>
