
<script>
import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, Button, Platform } from 'react-native';
import * as Location from 'expo-location';

export default function LocationTracker() {
  const [location, setLocation] = useState(null);
  const [errorMsg, setErrorMsg] = useState(null);
  const [watcher, setWatcher] = useState(null);

  const startTracking = async () => {
    let { status } = await Location.requestForegroundPermissionsAsync();
    if (status !== 'granted') {
      setErrorMsg('Permission to access location was denied');
      return;
    }

    const subscription = await Location.watchPositionAsync(
      {
        accuracy: Location.Accuracy.Highest,
        timeInterval: 5000, // in ms
        distanceInterval: 10, // in meters
      },
      (newLocation) => {
        setLocation(newLocation.coords);
      }
    );

    setWatcher(subscription);
  };

  const stopTracking = () => {
    if (watcher) {
      watcher.remove();
      setWatcher(null);
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>GPS Tracker</Text>
      {errorMsg ? (
        <Text style={styles.error}>{errorMsg}</Text>
      ) : (
        <Text>
          {location
            ? `Latitude: ${location.latitude}\nLongitude: ${location.longitude}`
            : 'Waiting for location...'}
        </Text>
      )}
      <Button title="Start Tracking" onPress={startTracking} />
      <Button title="Stop Tracking" onPress={stopTracking} color="red" />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    padding: 20,
    marginTop: 50,
  },
  title: {
    fontSize: 20,
    marginBottom: 10,
  },
  error: {
    color: 'red',
  },
});
</script>