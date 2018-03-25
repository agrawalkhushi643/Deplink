# Register Travis CI key
eval "$(ssh-agent -s)"
mkdir -p ~/.ssh && chmod 700 ~/.ssh
echo "${TRAVIS_KEY64}" > ~/.ssh/travis_rsa64
base64 --decode ~/.ssh/travis_rsa64 > ~/.ssh/travis_rsa
chmod 600 ~/.ssh/travis_rsa
ssh-add ~/.ssh/travis_rsa

# Publish new application using Deployer
vendor/bin/dep deploy --revision="${TRAVIS_COMMIT}"
