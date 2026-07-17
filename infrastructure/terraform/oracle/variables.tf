variable "compartment_id" {
  type        = string
  description = "OCI compartment OCID"
}

variable "region" {
  type        = string
  description = "OCI region (e.g. eu-frankfurt-1)"
}

variable "ssh_public_key" {
  type        = string
  description = "SSH public key for the ubuntu user"
}

variable "instance_display_name" {
  type        = string
  default     = "vm-php-supabase-api"
  description = "Compute instance display name"
}

variable "git_repo_url" {
  type        = string
  description = "HTTPS git URL cloned on first boot (your fork)"
}

variable "git_branch" {
  type        = string
  default     = "main"
}

variable "availability_domain" {
  type        = string
  description = "OCI availability domain name"
}

variable "subnet_id" {
  type        = string
  description = "Public subnet OCID"
}
