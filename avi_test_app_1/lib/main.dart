import 'package:avi_test_app/pages/image_picker.dart';

import './pages/splashScreen.dart';
import 'package:flutter/material.dart';

void main() => runApp(MyApp());


class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter Demo',
      theme: ThemeData(
        primarySwatch: Colors.blue
      ),
      home: new SplashScreen(),
    routes: <String, WidgetBuilder>{
      '/imagePicker': (BuildContext context) => new ImageInput()
    },
    );
  }
}