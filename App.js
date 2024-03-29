import React, { Component } from 'react';
import { Alert, Linking, Dimensions, LayoutAnimation, Text, Button, View, StatusBar, StyleSheet, TouchableOpacity } from 'react-native';
import { BarCodeScanner, Permissions} from 'expo';


export default class App extends Component {
  state = {
    hasCameraPermission: null,
    lastScannedUrl: null,
    qrcodeInfo: null,
    attendance : {}
  };

  componentDidMount() {
    this._requestCameraPermission();
    //set a deadline to push the marked attendance unto the server
    var date = new Date()
    //set deadline time 1min from current
    date.setMinutes(date.getMinutes() + 1)
    var deadline = date.getTime()

    //set an interval
    var x = setInterval(function() { 
    var now = new Date().getTime(); 
    var t = deadline - now; 
        if (t < 0) { 
            clearInterval(x); 
            //call function to push marked attendance to the server
            
        } 
    }, 1000);
  }

  _requestCameraPermission = async () => {
    const { status } = await Permissions.askAsync(Permissions.CAMERA);
    this.setState({
      hasCameraPermission: status === 'granted',
    });
  };
  

  render() {
    return (
      <View style={styles.container}>
        {this.state.hasCameraPermission === null
          ? <Text>Requesting for camera permission</Text>
          : this.state.hasCameraPermission === false
              ? <Text style={{ color: '#fff' }}>
                  Camera permission is not granted
                </Text>
              : <BarCodeScanner
                  onBarCodeRead={this._handleBarCodeRead}
                  style={{
                    height: Dimensions.get('window').height,
                    width: Dimensions.get('window').width,
                  }}
                />}

        {this._maybeRenderUrl()}

        <StatusBar hidden />
      </View>
    );
  }

  _handleBarCodeRead = result => {
    var date = new Date() //keep track of the time the scanned url was scanned
    var timestamp = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds()
    if (result.data !== this.state.lastScannedUrl) {
    //obtain qrcode number from the scanned data
      var qrcode = this._obtainqrcode(result.data)

      //fetch result from the server with the function fetchAsync with the qrcode no scanned
      this.fetchAsync(qrcode)
      .then(data => {
        this.setState({qrcodeInfo:data}) //set qrcode scanned information
        this._markattendance(qrcode, timestamp)
      }
        ) //function to handle the response from the server
      .catch(reason => console.log(reason.message)) // Handle any errors that may arise from fetch 
      //fecth qrcode information from qrcodes.php
      
      /*fetch('https://www.slitcorp.com/attendance/qrcodes.php', {
        method : 'POST',
        headers: { "Content-type": "application/x-www-form-urlencoded"},
        body: this._formEncode(member)
    })
    .then((response)=> response.json())
        .then((responseJson) => {
          console.log(responseJson)
          this.setState({qrcodeInfo: responseJson})  
          alert(responseJson['fname']+ " " + responseJson['oname'] + " " + responseJson['lname'])
        })
        .catch((error) => {
            console.error(error)
        })*/
      LayoutAnimation.spring();
      this.setState({ lastScannedUrl: result.data }); //Set the lastScannedUrl state to the scanned url
    }
  };


fetchAsync = async (qrcode) => {
  var qrcodeno = qrcode
  const member = {
          qrcodeno: qrcodeno
      }
    // await response of fetch call
    let response = await fetch('https://slitcorp.com/attendance/qrcodes.php', {
        method : 'POST',
        headers: { "Content-type": "application/x-www-form-urlencoded"},
        body: this._formEncode(member)
    });
    // only proceed once promise is resolved
    let data = await response.json();
    // only proceed once second promise is resolved
    return data;
  }

  //to push attendance data unto the server
  _pushAsync = async (attendance) => {
    const member = {
      data: attendance
    }
    let response = await fetch('https://slitcorp.com/attendance/uploadattendance.php', {
      method: 'POST',
      headers: { "Content-type": "application/x-www-form-urlencoded"},
      body: this._formEncode(member)
    })

    let data = await response.json();
    // only proceed once second promise is resolved
    return data;
  }

    //extract the actual qrcode from the scanned url
  _obtainqrcode = (url) => {
    var spliturl = url.split("/");
    var member = spliturl[spliturl.length - 1].split("=")
      return member[member.length - 1]
  }

  //encode qrcode as form data to be sent to server for processing
  _formEncode = (obj) => {
    var str = [];
        for(var p in obj)
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        return str.join("&");
  }

  _handlePressUrl = () => {
    Alert.alert(
      'Open this URL?',
      this.state.lastScannedUrl,
      [
        {
          text: 'Yes',
          onPress: () => Linking.openURL(this.state.lastScannedUrl),
        },
        { text: 'No', onPress: () => {} },
      ],
      { cancellable: false }
    );
  };

  //mark member as present
  _markattendance = (membercode, timestamp) => {
    //check if member has already been added
    if(this.state.attendance.hasOwnProperty(membercode)){
      alert("Already marked for "+this.state.qrcodeInfo['fname']+" "+ this.state.qrcodeInfo['lname'])
    }
    //else add to attendance
    else {
      //concatenate the attendance object with the scanned qrcode
    this.setState({
      attendance: {
        ...this.state.attendance,
        [membercode]: timestamp
      }
    })
    //testing phase
    console.log(this.state.attendance)//output the attendance data
    console.log(this.state.qrcodeInfo)
    }
    
  }

  //a function to push data unto the server
  _pushattendane = () => {
    //handle the pushing unto the server
    var attendance = this.state.attendance
    this._pushAsync(attendance)
    .then(data => console.log(data))
    .catch(reason => console.log(reason.message))

  }

  _handlePressCancel = () => {
    this.setState({ lastScannedUrl: null });
  };

  _maybeRenderUrl = () => {
    if (!this.state.lastScannedUrl) {
      return;
    }

    return (
      <View style={styles.bottomBar}>
        <TouchableOpacity style={styles.url} onPress={this._handlePressUrl}>
          <Text numberOfLines={1} style={styles.urlText}>
            {this.state.lastScannedUrl}
          </Text>
        </TouchableOpacity>
        <TouchableOpacity
          style={styles.cancelButton}
          onPress={this._handlePressCancel}>
          <Text style={styles.cancelButtonText}>
            Cancel
          </Text>
        </TouchableOpacity>
      </View>
    );
  };
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#000',
  },
  bottomBar: {
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
    backgroundColor: 'rgba(0,0,0,0.5)',
    padding: 15,
    flexDirection: 'row',
  },
  loginButton: {
    position: 'absolute',
    left: 50,
    right: 2,
    padding: 10,
    flexDirection: 'row',
    top: 0
  },
  url: {
    flex: 1,
  },
  urlText: {
    color: '#fff',
    fontSize: 20,
  },
  cancelButton: {
    marginLeft: 10,
    alignItems: 'center',
    justifyContent: 'center',
  },
  cancelButtonText: {
    color: 'rgba(255,255,255,0.8)',
    fontSize: 18,
  },
});

