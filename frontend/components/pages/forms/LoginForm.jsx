import React, {Component} from 'react';
import {hashHistory} from 'react-router';
import validate from 'validate.js';
import {rules} from '../validation/LoginRules';
import {
    NotificationContainer,
    NotificationManager
} from 'react-notifications';
import axios from 'axios';

export default class LoginForm extends Component {
    constructor(props) {
        super(props);

        this.state = {
            username: '',
            password: '',
        }
    }

    handleInputChange(field, e) {
        this.setState({
            [field]: e.target.value,
        });
    }

    submit(e) {
        e.preventDefault();

        if (!this.validate()) {
            return;
        }

        axios.post('/api/login', this.state)
            .then(({data}) => {

                if (data.hasOwnProperty('success') && data.success) {
                    localStorage.setItem('token', data.token);
                    hashHistory.push('/');
                    return;
                }

                NotificationManager.error(data.message);
            })
    }

    validate() {
        let errors = validate(this.state, rules);

        if (!errors) {
            return true;
        }

        /** Show first error */
        NotificationManager.error(errors[Object.keys(errors)[0]][0]);
        return false;
    }

    render() {
        return (
            <form onSubmit={this.submit.bind(this)}>
                <div className="form-group">
                    <label htmlFor="username">Username</label>
                    <input
                        type="text"
                        className="form-control"
                        id="username"
                        value={this.state.username}
                        onChange={this.handleInputChange.bind(this, 'username')}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="password">Password</label>
                    <input
                        type="password"
                        className="form-control"
                        id="password"
                        value={this.state.password}
                        onChange={this.handleInputChange.bind(this, 'password')}
                    />
                </div>
                <div className="form-group">
                    <input type="submit" className="btn btn-default" value="Login"/>
                </div>
                <NotificationContainer/>
            </form>
        );
    }
}