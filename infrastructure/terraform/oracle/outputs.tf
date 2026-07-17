output "public_ip" {
  description = "Public IPv4 of the API VM"
  value       = oci_core_instance.api.public_ip
}

output "instance_id" {
  value = oci_core_instance.api.id
}
