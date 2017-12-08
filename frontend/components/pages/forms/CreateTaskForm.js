import React, {Component} from 'react';
import validate from 'validate.js';
import {rules} from '../validation/CreateTaskRules';
import {
    NotificationContainer,
    NotificationManager
} from 'react-notifications';
import axios from 'axios';

export default class CreateTaskForm extends Component {

    constructor(props) {
        super(props);

        this.state = {
            username:   '',
            email:      '',
            text:       '',
        };
    }

    /**
     * Fields change handler
     *
     * @param field
     * @param e
     * @return void
     */
    handleInputChange(field, e) {
        this.setState({
            [field]: e.target.value,
        });
    }

    /**
     * Send create task request
     *
     * @param e
     * @return void
     */
    submit(e) {
        e.preventDefault();

        if (!this.validate()) {
            return;
        }

        axios.post('/api/task/create', this.state)
            .then((res) => {
                console.log(res);
            });
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
                    <label htmlFor="username">Username *</label>
                    <input
                        type="text"
                        className="form-control"
                        id="username"
                        value={this.state.username}
                        onChange={this.handleInputChange.bind(this, 'username')}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="email">Email *</label>
                    <input
                        type="text"
                        className="form-control"
                        id="email"
                        value={this.state.email}
                        onChange={this.handleInputChange.bind(this, 'email')}
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="text">Task content *</label>
                    <textarea
                        className="form-control"
                        id="text"
                        value={this.state.text}
                        onChange={this.handleInputChange.bind(this, 'text')}
                    />
                </div>
                <div className="form-group">
                    <input type="submit" className="btn btn-success" value="Create"/>
                </div>
                <NotificationContainer/>
            </form>
        );
    }
}