import React, {Component} from 'react'
import {
    AppRegistry,
    Stylesheet,
    Text,
    View,
    Button,
    TextInput
} from 'react-native'


export default class Login extends Component {
    constructor(props) {
        super(props)
        this.state = {
            username: '',
            password: ''
        }
    }

    UserLogin = () => {
        //alert('ok')
        const {username} = this.state;
        const {password} = this.state

        fetch('http://192.168.8.105/simple-qr-code-scanner/backend/login.php', {
            method : 'POST',
            headers : {
                'Accept' : 'application/json',
                'content-type': 'application/json'
            },
            body : JSON.stringify({
                username: username,
                password: password
            })
        })
        .then((response)=> response.json())
            .then((responseJson) => {
                alert(responseJson)
            })
            .catch((error) => {
                console.error(error)
            })
    }

    render() {
        <View style = {styles.container}>
            <TextInput placeholder= "Enter Username"
                style={{width:20, margin:10}}
                onChangeText={username => this.setState({username})}
            />
            
            <TextInput placeholder= "Enter Pasword"
                style={{width:200, margin:10}}
                onChangeText={[password => this.setState({password})]}
            />
            
            <Button title="Login" 
            onPress={this.UserLogin} />


        </View>
    }
}