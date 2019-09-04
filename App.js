import React, { Component } from 'react';
import { Alert, Linking, Dimensions, LayoutAnimation, Text, Button, View, StatusBar, StyleSheet, TouchableOpacity } from 'react-native';
import { BarCodeScanner, Permissions} from 'expo';

export default class App extends Component {
  state = {
    hasCameraPermission: null,
    lastScannedUrl: null,
    qrcodeInfo: null
  };

  componentDidMount() {
    this._requestCameraPermission();
  }

  _requestCameraPermission = async () => {
    const { status } = await Permissions.askAsync(Permissions.CAMERA);
    this.setState({
      hasCameraPermission: status === 'granted',
    });
  };

  //extract the actual qrcode from the scanned url
  obtainqrcode = (url) => {
    var spliturl = url.split("/");
      member = spliturl[spliturl.length - 1].split("=")
      return member[member.length - 1]
  }

  //encode qrcode as form data to be sent to server for processing
  formEncode = (obj) => {
    var str = [];
        for(var p in obj)
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        return str.join("&");
  }

  _handleBarCodeRead = result => {
    if (result.data !== this.state.lastScannedUrl) {
      var qrcode = this.obtainqrcode(result.data)
      const member = {
          qrcodeno: qrcode
      }
      //fecth qrcode information from qrcodes.php
      fetch('https://www.slitcorp.com/attendance/qrcodes.php', {
        method : 'POST',
        headers: { "Content-type": "application/x-www-form-urlencoded"},
        body: formEncode(member)
    })
    .then((response)=> response.json())
        .then((responseJson) => {
          this.setState({ lastScannedUrl: result.data });
          this.setState({qrcodeInfo: responseJson})  
          alert(responseJson['fname']+ " " + responseJson['oname'] + " " + responseJson['lname'])
        })
        .catch((error) => {
            console.error(error)
        })
      LayoutAnimation.spring();
      
    }
  };

  render() {
    return (
      <View style={styles.container}>
      <Button title="Login" style={styles.loginButton} />
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
            {this.state.qrcodeInfo['fname']+ " " + this.state.qrcodeInfo['oname'] + " " + this.state.qrcodeInfo['lname']}
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
    flexDirection: row,
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
