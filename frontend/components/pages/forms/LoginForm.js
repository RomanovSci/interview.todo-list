import React, {Component} from 'react'
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

        axios.post('/login', this.state)
            .then(({data}) => {

                if (data.success) {
                    //TODO: Handler
                }
            })
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