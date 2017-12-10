import React, {Component} from 'react';
import validate from 'validate.js';
import {rules} from '../validation/CreateTaskRules';
import {
    NotificationContainer,
    NotificationManager
} from 'react-notifications';
import axios from 'axios';
import {hashHistory} from 'react-router';
import FileInput from 'react-file-input';

export default class CreateTaskForm extends Component {

    constructor(props) {
        super(props);

        this.state = {
            username:   '',
            email:      '',
            text:       '',
            taskImage:  '',
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
     * Handle file select
     *
     * @param e
     * @return void
     */
    handleFileSelect(e) {
        e.preventDefault();

        let availableTypes = ['image/jpeg', 'image/gif', 'image/png',];
        let taskImage = e.target.files[0];

        if (availableTypes.indexOf(taskImage.type) === -1) {
            NotificationManager.error('Incorrect image type');
            return;
        }

        this.setState({taskImage});
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

        let formData = new FormData();

        for (let key in this.state) {
            formData.append(key, this.state[key]);
        }

        axios.post('/api/task/create', formData)
            .then(({data}) => {
                if (data.success) {
                    NotificationManager.success('Done ^_^.');

                    setTimeout(() => {
                        hashHistory.push('/');
                    }, 1000);
                }
            });
    }

    /**
     * Validate fields
     *
     * @return boolean
     */
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
                    <label htmlFor="picture">Picture</label>
                    <FileInput
                        id="picture"
                        accept=".png,.gif,.jpeg"
                        placeholder="Click here for selecting"
                        className="form-control"
                        onChange={this.handleFileSelect.bind(this)}
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