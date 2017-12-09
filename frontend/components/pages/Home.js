import React, {Component} from 'react';
import axios from 'axios';
import {
    NotificationManager,
    NotificationContainer
} from 'react-notifications';

export default class Home extends Component {

    constructor(props) {
        super(props);

        this.state = {
            tasks: null,
        }
    }

    componentDidMount() {
        axios.get('/api/tasks')
            .then(({data}) => {

                if (data.success) {
                    this.setState({tasks: data.tasks});
                    return;
                }

                NotificationManager.error('Cant load task list');
            });
    }

    renderTaskList() {
        if (!this.state.tasks) {
            return <p>Loading...</p>;
        }

        if (Array.isArray(this.state.tasks) && !this.state.tasks.length) {
            return <p>No tasks yet</p>
        }

        return this.state.tasks.map((task, index) => {
            return (
                <div className="row" key={index}>
                    <div className="col-1">{task.id}</div>
                    <div className="col-3">{task.username}</div>
                    <div className="col-3">{task.email}</div>
                    <div className="col-5">{task.text}</div>
                </div>
            );
        });
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-md-center">
                    <div className="col-12 text-center">
                        <h1>Tasks</h1>
                    </div>
                    <div className="col-8">
                        {this.renderTaskList()}
                    </div>
                </div>
                <NotificationContainer/>
            </div>
        );
    }
}