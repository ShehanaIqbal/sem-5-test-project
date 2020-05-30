import 'dart:async';
import 'package:flutter/material.dart';

class SplashScreen extends StatefulWidget {
  @override
  _SplashScreenState createState() => new _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  startTime() async {
    var _duration = new Duration(seconds: 2);
    return new Timer(_duration, navigationPage);
  }

  void navigationPage() {
  Navigator.of(context).pushReplacementNamed('/imagePicker');
}

@override
void initState() {
  super.initState();
  startTime();
}

@override
  Widget build(BuildContext context) {
  return new Scaffold(
      body: Center(
        child:Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: <Widget>[
        /// Loader Animation Widget
        CircularProgressIndicator(
          valueColor: new AlwaysStoppedAnimation<Color>(
              Colors.indigoAccent),
        ),
        Padding(
          padding: const EdgeInsets.only(top: 20.0),
        ),
      ]
  ) ,
        )
    );
    
  }
}